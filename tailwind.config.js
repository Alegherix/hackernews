module.exports = {
  // Purge all unused styles in prod builds for these paths
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './resources/**/*.scss', // Unsure about this one
  ],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {
		colors: {
			'commentBtn-bg': '#303955',
		  }
	},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
