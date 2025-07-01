const path = require("path");

module.exports = {
  entry: {
    index: "./smart-cinema-client/scripts/pages/index/main.js",
    home: "./smart-cinema-client/scripts/pages/home/main.js",
  },
  output: {
    filename: "[name].bundle.js", // [name] is the key from the entry object
    path: path.resolve(__dirname, "public"),
  },
  mode: "development",
  devtool: "eval-source-map",
};
