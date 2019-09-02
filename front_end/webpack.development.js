const merge = require("webpack-merge");
const webpack = require("webpack");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const Fiber = require("fibers");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const path = require("path");
const common = require("./webpack.common.js");

module.exports = merge(common(), {
  mode: "development",
  devtool: "eval-source-map",
  module: {
    rules: [
      {
        test: /\.(s*)css$/,
        use: [
          {
            loader: "style-loader"
          },
          {
            loader: "css-loader", // translates CSS into CommonJS
            options: {
              importLoaders: 1,
              sourceMap: true
            }
          },
          {
            loader: "postcss-loader", // translates CSS into CommonJS
            options: {
              plugins: () => [
                require("postcss-import"),
                require("postcss-preset-env")
              ],
              sourceMap: "true"
            }
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("dart-sass"),
              fiber: Fiber,
              sourceMap: true
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new BrowserSyncPlugin(
      {
        open: false,
        logFileChanges: false,
        port: 3000,
        ui: { port: 3100 },
        proxy: "localhost:80/kommi/",
        files: [
          {
            match: [
              path.join(__dirname, "../assets/main.bundle.css"),
              path.join(__dirname, "../assets/main.bundle.js"),
              path.join(__dirname, "**/*.php"),
              path.join(__dirname, "**/*.html")
            ],
            fn: function(event, file) {
              if (event === "change") {
                const bs = require("browser-sync").get("bs-webpack-plugin");
                bs.reload();
              }
            }
          }
        ]
      },
      {
        reload: true
      }
    )
  ]
});
