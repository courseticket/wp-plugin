module.exports = {
    options: {
        config: 'compass.rb',
        noLineComments: true
    },
    dist: {
        options: {
            environment: 'production',
            outputStyle: 'compressed'
        }
    },
    dev: {
        options: {
            environment: 'development',
            outputStyle: 'nested'
        }
    }
};