# Minimal Theme

A clean, lightweight WordPress theme designed with simplicity in mind. This theme provides a classic WordPress experience without Gutenberg blocks, with a focus on performance and accessibility.

## Goal

- Minimal ACF (ACF Pro & ACF Extended Pro) starter theme for client projects
- Get rid of other plugins
- Cleaned WP Backend
- scss workflow

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Node.js and NPM (for SCSS development)

## Development Setup

This theme uses SCSS for styling, which needs to be compiled to CSS. Follow these steps to set up the development environment:

### Initial Setup

1. Make sure you have Node.js installed on your computer
2. Navigate to the theme directory in your terminal
3. Run `npm install` to install all dependencies

### SCSS Development

The theme uses a modern SCSS workflow:

```
scss/
├── cms/              # WP Backend & Login Styles
├── components/       # ACF Flexible Content Components
├── templates/        # Header, Footer, Navigation and Template Styles
├── util/             # Variables, Resets and Mixins
└── main.scss         # Main SCSS file
```

### NPM Commands

- `npm run build` - Compile SCSS to CSS once
- `npm start` - Watch for SCSS changes and compile automatically
- `npm run sass` - Just compile SCSS without watching
- `npm run postcss` - Apply Autoprefixer to CSS files

### Daily Development Workflow

1. Navigate to the theme directory in your terminal
2. Run `npm start` to start the SCSS compiler in watch mode
3. Edit SCSS files in the `scss/` directory
4. The compiler will automatically generate CSS files

## Theme Structure

wip

## Admin Enhancements

This theme includes several admin UI improvements:
- Removal of unnecessary WordPress dashboard widgets
- Disabling of comments functionality
- Cleaner admin bar
- Removal of Gutenberg and block editor
- Disabling of pingbacks and trackbacks

## Customization

The theme can be customized through:
1. WordPress Customizer
2. Editing SCSS variables in `scss/abstracts/_variables.scss`
3. Adding custom CSS to `css/custom.css`

## License

This theme is licensed under the GPL v2 or later.

## Support

For support or feature requests, please open an issue on GitHub or contact the theme author.