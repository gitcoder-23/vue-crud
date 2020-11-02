module.exports = {
    devServer: {
      proxy: {
        '^/api': {
          target: 'https://gorest.co.in',
          ws: true,
          changeOrigin: true
        },
        // '^/foo': {
        //   target: '<other_url>'
        // }
      }
    }
  }