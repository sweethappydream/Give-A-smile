const path = require('path');
// const CleanWebpackPlugin = require('clean-webpack-plugin');
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

const config = {
  host: 'localhost',
  port: 3000
};

module.exports = {
  entry: [
    path.join(__dirname, 'src/js/app.js'),
    path.join(__dirname, 'src/scss/main.scss'),
  ],
  output: {
    filename: './js/app.min.js',
  },
  externals: {
    jquery: 'jQuery'
  },
  module: {
    rules: [{
        test: /\.js$/,
        exclude: /node_modules/,
        use: 'babel-loader'
      },
      {
        test: /\.(sass|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
          'postcss-loader',
        ]
      },
      {
        test: /\.(ttf|eot|woff2?|otf)$/,
        loader: 'url-loader',
        options: {
          limit: 4096,
          name: '[name].[ext]',
          outputPath: 'css/assets/fonts',
          publicPath: url => 'assets/fonts/' + url,
        },
      },
      {
        test: /\.(png|jpe?g|gif|svg|ico)$/,
        loader: 'url-loader',
        options: {
          limit: 4096,
          name: '[name].[ext]',
          outputPath: 'css/assets/img',
          publicPath: url => 'assets/img/' + url,
        },
      },
    ]
  },
  plugins: [
    // new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: './css/main.min.css'
    }),
  ],
  optimization: {
    minimizer: [
      new UglifyJSPlugin({
        cache: false,
        parallel: true
      }),
      new OptimizeCSSAssetsPlugin({})
    ]
  }
};