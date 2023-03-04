const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');*/

   /* mix.webpackConfig({
        module: {
            rules: [
                {
                    test: /\.less$/,
                    use: [
                        {
                            loader: 'style-loader',
                        },
                        {
                            loader: 'css-loader',
                        },
                        {
                            loader: 'less-loader',
                            options: {
                                javascriptEnabled: true,
                            },
                        },
                    ],
                },
            ],
        },
    });*/
    
   /* mix.webpackConfig({
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js')
            ]
        }
    });*/
    /*.less('resources/js/css/ant-theme.less', 'public/css');/*.options({
        lessOptions: {
            javascriptEnabled: true,
        },
    });*/
    
    /*mix.webpackConfig({
        module: {
            rules: [
                {
                    test: /\.less$/,
                    use: [
                        'vue-style-loader',
                        'css-loader',
                        'postcss-loader',
                        'less-loader',
                    ],
                },
            ],
        },
    });*/
    mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.less$/,
                    loader: 'less-loader',
                    options: {
                        lessOptions: {
                            modifyVars: {
                                        'primary-color': '#1DA57A',
                                        'link-color': '#1DA57A',
                                        'border-radius-base': '2px'
                            },
                            javascriptEnabled: true
                        }
                    }
                },
            ]
        }
    })
    .sourceMaps();
    /*.less('resources/js/css/ant-theme.less', 'public/css',{
        lessOptions: {
            strictMath: true,
            javascriptEnabled: true,
        }});*//*.options({
        lessOptions: {
            /*modifyVars: {
                'primary-color': '#F5222D' // optional, to override antd variables
            },
            javascriptEnabled: true,
        },
    });*/

    /*
    mix.webpackConfig({
        module: {
          rules: [
            {
              test: /\.less$/,
              use: [
                {
                    loader: "style-loader", // creates style nodes from JS strings
                  },
                  {
                    loader: "css-loader", // translates CSS into CommonJS
                  },
                  {
                    loader: "less-loader", // compiles Less to CSS
                  },
               /* {
                  loader: 'less-loader',
                  options: {
                    javascriptEnabled: true,
                  },
                },
              ],
            },
          ],
        },
      });*/
      
    /*
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.less$/,
                    use: [
                        'style-loader',
                        'css-loader',
                        {
                            loader: 'less-loader',
                            options: {
                                lessOptions: {
                                    javascriptEnabled: true,
                                },
                            },
                        },
                    ],
                },
            ],
        },
    });*/

    /*import Quill from "quill";
    import { ImageResize } from "quill-image-resize-module";
    
    Quill.register("modules/imageResize", ImageResize);
    
    const quill = new Quill(editor, {
        // ...
        modules: {
            // ...
                ImageResize: {
                    modules: ["Resize", "DisplaySize", "Toolbar"]
            }
        }
    });*/
