const merge = require("webpack-merge");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const WebpackAssetsManifest = require("webpack-assets-manifest");
const Fiber = require("fibers");
const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const common = require("./webpack.common");
const path = require("path");

module.exports = merge(common(), {
  mode: "production",
  devtool: "source-map",
  module: {
    rules: [
      {
        test: /\.(s*)css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: "../assets",
              hmr: true
            }
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
  output: {
    filename: "app.bundle.min.js",
    path: path.join(__dirname, "../assets")
  },
  plugins: [
    new OptimizeCssAssetsPlugin({
      assetNameRegExp: /\.css$/g,
      cssProcessor: require("cssnano"),
      cssProcessorPluginOptions: {
        preset: ["default", { discardComments: { removeAll: true } }]
      },
      canPrint: true
    }),
    new MiniCssExtractPlugin({
      filename:
        this.mode === "development"
          ? "[name].app.bundle.css"
          : "app.bundle.css",
      chunkFilename:
        this.mode === "development" ? "[id].app.bundle.css" : "app.bundle.css"
    }),
    new WebpackAssetsManifest()
  ]
});
