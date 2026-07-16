# Development & Testing Notes

## Testing Checklist

### Basic Functionality
- [ ] Plugin activates without errors
- [ ] Elementor/Pro dependency checks work
- [ ] Icon controls appear in form field settings
- [ ] Icons render on frontend

### Icon Positions
- [ ] Above field - renders correctly
- [ ] Inside left - icon appears, padding correct
- [ ] Inside right - icon appears, padding correct  
- [ ] In placeholder - emoji shows in placeholder

### Field Types
- [ ] Text field
- [ ] Email field
- [ ] Textarea field
- [ ] Tel field
- [ ] URL field
- [ ] Password field
- [ ] Number field

### Customization
- [ ] Icon color changes work
- [ ] Icon size adjusts properly
- [ ] Different icons per field
- [ ] Multiple fields with icons

### Responsive
- [ ] Desktop view
- [ ] Tablet view
- [ ] Mobile view
- [ ] RTL languages

### Browser Testing
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge

## Known Limitations

1. **Elementor Pro Required**: This is by design as we're extending Pro's Form Widget
2. **Icon Library**: Currently supports Font Awesome only
3. **Placeholder Icons**: Use emoji fallbacks for better compatibility
4. **Custom Field Types**: May need additional hooks for non-standard fields

## Development Roadmap

### Version 1.1
- [ ] Icon preview in editor
- [ ] Icon search/browse interface
- [ ] Animation options
- [ ] More icon libraries (Material Icons, etc.)

### Version 1.2
- [ ] Conditional icon display
- [ ] Icon tooltips
- [ ] Click actions on icons
- [ ] Field validation indicators

### Version 2.0
- [ ] Custom icon upload
- [ ] SVG icon support
- [ ] Icon presets library
- [ ] Form templates with icons

## Code Quality Checklist

- [x] WordPress coding standards
- [x] Proper escaping and sanitization
- [x] Nonces for security (N/A - no form submissions)
- [x] Internationalization ready
- [x] Documentation/comments
- [x] Error handling
- [x] Accessibility considerations

## WordPress.org Submission Checklist

Before submitting to WordPress.org:

1. **Code Review**
   - [ ] Run PHP_CodeSniffer with WordPress standards
   - [ ] Check for deprecated functions
   - [ ] Verify all strings are translatable
   - [ ] Remove debugging code

2. **Testing**
   - [ ] Test on fresh WordPress install
   - [ ] Test with default theme (Twenty Twenty-Four)
   - [ ] Test with popular themes
   - [ ] Test with other popular plugins

3. **Documentation**
   - [x] Detailed readme.txt
   - [x] Screenshots prepared
   - [ ] FAQ section complete
   - [x] Installation instructions clear

4. **Assets**
   - [ ] Plugin banner (1544×500)
   - [ ] Plugin icon (256×256)
   - [ ] Screenshots (1200×900 recommended)

5. **Legal**
   - [x] GPL compatible license
   - [ ] Third-party asset licenses verified
   - [x] Copyright notices included

## PHP CodeSniffer Commands

```bash
# Install WordPress coding standards
composer require --dev wp-coding-standards/wpcs

# Run checks
phpcs --standard=WordPress --extensions=php /path/to/plugin

# Auto-fix issues
phpcbf --standard=WordPress --extensions=php /path/to/plugin
```

## Testing with Different Elementor Versions

Test with:
- Latest Elementor stable
- Latest Elementor Pro stable
- One version back (compatibility)

## Performance Notes

- Font Awesome loaded conditionally
- CSS/JS only on pages with Elementor
- Minimal DOM manipulation
- No database queries added
- No external API calls

## Security Considerations

- All user input sanitized
- Output properly escaped
- No direct file access allowed
- Nonce checks where applicable (N/A currently)
- Capability checks for admin (N/A - uses Elementor's controls)

## Debugging

Enable WordPress debugging:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Check Elementor debug mode:
Elementor > Tools > Replace URL > Enable Elementor Debug

## Common Issues During Development

### Icons not appearing
- Check browser console for JS errors
- Verify Font Awesome is loading
- Check CSS is enqueued
- Inspect HTML for data attributes

### Controls not showing
- Clear Elementor cache
- Regenerate files
- Check Elementor version compatibility

### Styling conflicts
- Check theme CSS specificity
- Use !important sparingly
- Add fallback styles

## Browser Dev Tools Checklist

1. Check Network tab - all assets loading?
2. Check Console - any JS errors?
3. Check Elements - data attributes present?
4. Check Computed styles - CSS applying correctly?

## Git Workflow

```bash
# Feature development
git checkout -b feature/icon-preview
# ... make changes ...
git commit -m "Add icon preview in editor"
git push origin feature/icon-preview

# Bug fixes
git checkout -b fix/icon-alignment
# ... make changes ...
git commit -m "Fix icon alignment on mobile"
git push origin fix/icon-alignment
```

## Release Process

1. Update version numbers
   - Main plugin file
   - readme.txt
   - readme.md

2. Update changelog
   - readme.txt
   - readme.md

3. Test thoroughly
   - Run full testing checklist
   - Test on staging site

4. Tag release
   ```bash
   git tag -a v1.0.0 -m "Version 1.0.0"
   git push origin v1.0.0
   ```

5. Deploy
   - WordPress.org SVN (if listed)
   - GitHub release
   - littlewebshack.com

## Support & Maintenance

- Monitor WordPress.org support forums
- Check GitHub issues
- Update for new Elementor versions
- Test with new WordPress releases
- Keep Font Awesome updated

---

**Last Updated**: January 2026
**Current Version**: 1.0.0
**Next Review**: When Elementor Pro updates
