module.exports = {
    client: {
      service: {
        name: 'loja-da-rafa',
        // URL to the GraphQL API
        url: 'http://localhost:3000/graphql',
      },
      // Files processed by the extension
      includes: [
        'resources/**/*.vue',
        'resources/**/*.js',
      ],
    },
}
