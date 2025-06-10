# LLP WordPress Block Theme

A modern WordPress block theme designed specifically for full-site editing, featuring clean aesthetics and comprehensive customization options.

## Description

LLP is a WordPress block theme built for the modern web, leveraging the power of WordPress's Full Site Editing (FSE) capabilities. Created by JaxWeb, this theme provides a solid foundation for building custom websites with the WordPress block editor.

## Features

- **Full Site Editing Support**: Built for WordPress 6.3+ with complete FSE compatibility
- **Custom Block Styles**: Enhanced styling for core blocks including buttons, quotes, navigation, and search
- **Block Patterns**: Pre-designed layouts for quick site building
- **Mobile Responsive**: Optimized for all device sizes with dedicated mobile menu functionality
- **Google Fonts Integration**: Easy font management and loading
- **Floating Menu**: Interactive navigation component
- **Custom Post Navigation**: Enhanced post browsing experience
- **Multiple Template Options**: Various page templates including full-width layouts
- **WooCommerce Ready**: Built-in WooCommerce styling support
- **Polylang Integration**: Full support for language-specific template parts, menus, and styling

## Requirements

- **WordPress**: 6.3 or higher
- **PHP**: 7.4 or higher
- **License**: GPL v2 or later

## Installation

### Via WordPress Admin

1. Download the theme zip file
2. Go to **Appearance > Themes** in your WordPress admin
3. Click **Add New** then **Upload Theme**
4. Choose the downloaded zip file and click **Install Now**
5. Activate the theme

### Via FTP

1. Extract the theme files
2. Upload the `llp` folder to `/wp-content/themes/`
3. Go to **Appearance > Themes** and activate the LLP theme

## Theme Structure

```
llp/
├── assets/
│   ├── css/           # Stylesheets and block styles
│   ├── images/        # Theme images
│   └── js/            # JavaScript files
├── inc/               # PHP includes and functionality
├── parts/             # Template parts
├── patterns/          # Block patterns
├── styles/            # Theme style variations
├── templates/         # Block templates
├── functions.php      # Theme functions
├── style.css          # Main stylesheet
└── theme.json         # Theme configuration
```

## Polylang Integration

This theme includes comprehensive Polylang support for multilingual websites:

- **Language-Specific Template Parts**: Create headers, footers, and other template parts for each language
- **Automatic Menu Switching**: Language-specific menus that switch automatically
- **Language-Specific Styling**: CSS files that load based on the current language
- **SEO Optimization**: Automatic language meta tags and hreflang links

For detailed setup instructions, see [POLYLANG-INTEGRATION.md](POLYLANG-INTEGRATION.md).

### Quick Setup
1. Install and configure the Polylang plugin
2. Create language-specific template parts (e.g., `header-da.html`, `footer-en.html`)
3. Set up language-specific menus in **Appearance > Menus**
4. Optionally create language-specific CSS files

## Customization

### Block Styles

The theme includes custom styles for the following core blocks:
- **Button**: Enhanced button styling
- **Quote**: Custom quote block appearance
- **Navigation**: Styled navigation menus
- **Search**: Custom search block design

### Menus

The theme supports two menu locations:
- **Top Menu** (`topmenu`)
- **Main Menu** (`hovedmenu`)

Register your menus in **Appearance > Menus**.

### Colors & Typography

Theme colors and typography can be customized through:
- The WordPress Customizer
- The Full Site Editor
- The `theme.json` file for advanced users

### Development

The theme includes a complete development workflow:

```bash
# Install dependencies
npm install
composer install

# Build assets
gulp build

# Watch for changes during development
gulp watch
```

## Block Patterns

The theme includes several pre-built block patterns:
- Columns with images
- Dual images layout
- Header with featured image
- Quote with image
- Custom query layouts
- And more...

## Template Parts

Available template parts:
- Header
- Footer
- Narrow header/footer variants
- Sidebar
- Post navigation

## JavaScript Features

- **Mobile Menu**: Responsive navigation with jQuery
- **Floating Menu**: Interactive menu component
- **Block Variations**: Custom block variations
- **Smooth Scrolling**: Enhanced user experience

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Contributing

This theme is developed by JaxWeb. For issues or feature requests, please contact the development team.

## Development Tools

The theme uses modern development tools:
- **Gulp**: Task runner for asset compilation
- **PostCSS**: CSS processing
- **PHP CodeSniffer**: Code quality assurance
- **PHPStan**: Static analysis

## License

This theme is licensed under the GPL v2 or later.
- **License**: [GNU General Public License v2 or later](http://www.gnu.org/licenses/gpl-2.0.html)
- **License URI**: http://www.gnu.org/licenses/gpl-2.0.html

## Credits

- **Developer**: JaxWeb
- **Website**: [https://www.jaxweb.dk](https://www.jaxweb.dk)
- **Theme URI**: [https://www.jaxweb.dk/llp](https://www.jaxweb.dk/llp)

## Changelog

### Version 1.0.0
- Initial release
- Full Site Editing support
- Custom block styles
- Mobile responsive design
- Block patterns library
- Google Fonts integration

---

For support and documentation, visit [JaxWeb](https://www.jaxweb.dk).
