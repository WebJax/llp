# Polylang Integration Guide

This theme includes comprehensive Polylang support that allows you to create language-specific template parts, menus, and styling.

## Setup

1. **Install Polylang Plugin**
   - Install and activate the Polylang plugin
   - Configure your languages in `Settings > Languages`

2. **Theme Activation**
   - The theme automatically detects Polylang and enables language-specific features
   - Language-specific menu locations will be registered automatically

## Language-Specific Template Parts

### Creating Language-Specific Templates

For each template part, you can create language-specific versions by adding the language code as a suffix:

**Original template parts:**
- `parts/header.html`
- `parts/footer.html`
- `parts/narrow-header.html`
- `parts/narrow-footer.html`

**Language-specific versions (for Danish 'da', English 'en', and German 'ge'):**
- `parts/header-da.html` (Danish header)
- `parts/header-en.html` (English header)
- `parts/header-ge.html` (German header)
- `parts/footer-da.html` (Danish footer)
- `parts/footer-en.html` (English footer)
- `parts/footer-ge.html` (German footer)
- `parts/narrow-header-da.html`
- `parts/narrow-footer-en.html`
- `parts/narrow-header-ge.html`

### How It Works

1. **Automatic Detection**: The theme automatically detects the current language
2. **Template Fallback**: If a language-specific template doesn't exist, it falls back to the default template
3. **Seamless Integration**: Works with WordPress Full Site Editor

### Example Template Structure

```
parts/
├── header.html          # Default header (fallback)
├── header-da.html       # Danish header
├── header-en.html       # English header
├── header-ge.html       # German header
├── footer.html          # Default footer (fallback)
├── footer-da.html       # Danish footer
├── footer-en.html       # English footer
├── footer-ge.html       # German footer
└── ...
```

## Language-Specific Menus

### Menu Locations

The theme automatically creates language-specific menu locations:

**Default menu locations:**
- `topmenu` - Top Menu
- `hovedmenu` - Main Menu (Hoved Menu)

**Language-specific menu locations:**
- `topmenu-da` - Top Menu (Danish)
- `topmenu-en` - Top Menu (English)
- `topmenu-ge` - Top Menu (German)
- `hovedmenu-da` - Main Menu (Danish)
- `hovedmenu-en` - Main Menu (English)
- `hovedmenu-ge` - Main Menu (German)

### Setting Up Language Menus

1. Go to **Appearance > Menus**
2. Create separate menus for each language
3. Assign them to the appropriate language-specific menu locations
4. The theme will automatically display the correct menu based on the current language

## Language-Specific Styling

### CSS Classes

The theme automatically adds language-specific CSS classes to the body:

```css
.lang-da { /* Danish language styles */ }
.lang-en { /* English language styles */ }
.lang-ge { /* German language styles */ }
.lang-default { /* Default language styles */ }
```

### Language-Specific CSS Files

You can create language-specific CSS files that will be automatically loaded:

- `assets/css/lang-da.css` - Danish styles
- `assets/css/lang-en.css` - English styles
- `assets/css/lang-ge.css` - German styles
- `assets/css/lang-[language-code].css` - Any language

### Example Language-Specific Styles

```css
/* Danish specific styles */
.lang-da .wp-block-navigation {
    /* Danish navigation styles */
}

.lang-da .site-title {
    /* Danish site title styles */
}

/* English specific styles */
.lang-en .wp-block-navigation {
    /* English navigation styles */
}

/* German specific styles */
.lang-ge .wp-block-navigation {
    /* German navigation styles */
}

.lang-ge .site-title {
    /* German site title styles */
}
```

## Helper Functions

### PHP Functions

**Get current language menu location:**
```php
$menu_location = llp_get_language_menu_location('topmenu');
```

**Display language-specific template part:**
```php
llp_language_template_part('header');
```

**Display language switcher:**
```php
llp_language_switcher([
    'show_names' => 1,
    'show_flags' => 1,
    'dropdown' => 0
]);
```

## Advanced Features

### RTL Language Support

The integration automatically detects RTL languages and adds appropriate classes:

```php
if (LLP_Polylang_Integration::is_rtl_language()) {
    // RTL specific code
}
```

### Language Meta Tags

The theme automatically adds language meta tags and alternate language links for SEO:

```html
<meta name="language" content="da_DK">
<link rel="alternate" hreflang="en" href="https://example.com/en/">
<link rel="alternate" hreflang="da" href="https://example.com/da/">
```

## Best Practices

### 1. Content Strategy
- Create language-specific content for headers and footers
- Use different imagery for different cultures
- Adapt navigation structures for each language

### 2. Menu Management
- Keep menu structures consistent across languages
- Use descriptive menu names with language indicators
- Test menu functionality in both languages

### 3. Template Organization
- Always create a default template as fallback
- Use consistent naming conventions
- Document language-specific customizations

### 4. Performance
- Language-specific CSS files are only loaded when needed
- Template parts are cached by WordPress
- Minimal performance impact

## Troubleshooting

### Common Issues

**Templates not switching:**
- Check that Polylang is active and configured
- Verify language-specific template files exist
- Clear any caching plugins

**Menus not displaying:**
- Ensure language-specific menus are created and assigned
- Check menu location names match the pattern
- Verify menu items exist for each language

**Styles not loading:**
- Check that language-specific CSS files exist
- Verify file permissions
- Clear browser cache

### Debug Information

Add this to your `wp-config.php` for debugging:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Migration Guide

### From Single Language to Multi-Language

1. **Backup your site**
2. **Install and configure Polylang**
3. **Create language-specific template parts**
4. **Set up language-specific menus**
5. **Test thoroughly**
6. **Update content and translations**

### Template Migration

1. Copy existing template parts
2. Add language suffix to filenames
3. Customize content for each language
4. Test language switching functionality

## Support

For issues related to this Polylang integration, check:

1. **WordPress debug logs**
2. **Polylang plugin status**
3. **Template file permissions**
4. **Menu assignments**

Remember to always test language switching functionality after making changes to template parts or menus.
