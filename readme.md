# Minimal Theme

A clean, lightweight WordPress theme designed with simplicity in mind. This theme provides a classic WordPress experience without Gutenberg blocks, with a focus on performance and clean code.

## Features

- ACF & ACF Extended at it's core
- No Gutenberg Blocks
- Cleaned WP Backend
- SCSS workflow for advanced styling

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Node.js and NPM (for SCSS development)

## Installation

1. Upload the theme folder to your `/wp-content/themes/` directory
2. Activate the theme through the 'Themes' menu in WordPress
3. Configure theme settings through the WordPress Customizer

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
├── abstracts/        # Variables, mixins, functions
├── components/       # Component styles (header, footer, etc.)
├── layouts/          # Layout styles
├── admin/            # Admin-specific styles
└── main.scss         # Main SCSS file that imports all others
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

```
minimal-theme/
├── admin-enhancements/  # Admin UI customizations
├── css/                # Compiled CSS files
├── js/                 # JavaScript files
├── scss/               # SCSS source files
├── index.php           # Main template file
├── functions.php       # Theme functions
├── header.php          # Header template
├── footer.php          # Footer template
└── style.css           # Theme information
```

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