const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const path = require("path");

module.exports = () => ({
  entry: {
    main: ["@babel/polyfill", "./main.js"]
  },
  resolve: {
    alias: {
      src: path.resolve(__dirname, "./src/"),
      css: path.resolve(__dirname, "./assets/css/"),
      fonts: path.resolve(__dirname, "./assets/fonts/"),
      images: path.resolve(__dirname, "./assets/images/")
    },
    extensions: [".js", ".json", ".css", ".scss"]
  },
  output: {
    path: path.resolve(__dirname, "../assets"),
    filename: "app.bundle.js"
  },
  module: {
    rules: [
      {
        test: /\.(html)$/,
        loader: "html-loader",
        options: {
          name: "[name].[ext]"
        }
      },
      {
        test: /\.js$/,
        use: {
          loader: "babel-loader",
          options: { presets: ["@babel/preset-env"] }
        }
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/i,
        exclude: [/\.*\/images/i],
        use: [
          {
            loader: "file-loader",
            options: {
              name:
                this.mode === "development"
                  ? "[name]-[hash].[ext]"
                  : "[name].[ext]",
              outputPath: "fonts/"
            }
          }
        ]
      },
      {
        test: /\.(jpe?g|png|gif|svg|cur)$/i,
        exclude: [/\.*\/fonts/i],
        use: [
          {
            loader: "file-loader",
            options: {
              name:
                this.mode === "development"
                  ? "[name]-[hash].[ext]"
                  : "[name].[ext]",
              outputPath: "images/"
            }
          }
        ]
      }
    ]
  }
});
