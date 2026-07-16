# Usage Examples - MBR Elementor Form Icons

## Common Form Patterns

### 1. Contact Form

A typical contact form with appropriate icons:

```
Name Field
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: user
- Position: Inside Field (Left)
- Color: #555555
- Size: 16px

Email Field
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: envelope
- Position: Inside Field (Left)
- Color: #555555
- Size: 16px

Phone Field
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: phone
- Position: Inside Field (Left)
- Color: #555555
- Size: 16px

Subject Field
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: tag
- Position: Inside Field (Left)
- Color: #555555
- Size: 16px

Message Field
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: comment
- Position: Above Field
- Color: #555555
- Size: 18px
```

### 2. Login Form

Simple login with security-focused icons:

```
Username/Email
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: user
- Position: Inside Field (Left)
- Color: #0066cc
- Size: 16px

Password
- Enable Icon: Yes
- Icon Library: Font Awesome Solid
- Icon Class: lock
- Position: Inside Field (Left)
- Color: #0066cc
- Size: 16px
```

### 3. Registration Form

Extended signup form:

```
Full Name
- Icon Class: user
- Position: Inside Field (Left)

Email Address
- Icon Class: envelope
- Position: Inside Field (Left)

Phone Number
- Icon Class: phone
- Position: Inside Field (Left)

Password
- Icon Class: lock
- Position: Inside Field (Left)

Confirm Password
- Icon Class: lock
- Position: Inside Field (Right)
- Color: #28a745 (green for confirmation)

Date of Birth
- Icon Class: calendar
- Position: Above Field
```

### 4. Business Inquiry Form

Professional B2B contact form:

```
Company Name
- Icon Class: building
- Position: Inside Field (Left)

Contact Person
- Icon Class: user-tie
- Position: Inside Field (Left)

Business Email
- Icon Class: envelope
- Position: Inside Field (Left)

Company Website
- Icon Class: globe
- Position: Inside Field (Left)

Industry
- Icon Class: briefcase
- Position: Above Field

Budget Range
- Icon Class: dollar-sign
- Position: Above Field
```

### 5. Booking/Reservation Form

Service booking form:

```
Your Name
- Icon Class: user
- Position: In Placeholder

Service Date
- Icon Class: calendar
- Position: Inside Field (Left)

Time Slot
- Icon Class: clock
- Position: Inside Field (Left)

Number of Guests
- Icon Class: users
- Position: Inside Field (Left)

Special Requests
- Icon Class: comment-dots
- Position: Above Field
```

### 6. Support Ticket Form

Customer support submission:

```
Your Name
- Icon Class: user
- Position: Inside Field (Left)

Email
- Icon Class: envelope
- Position: Inside Field (Left)

Order Number
- Icon Class: hashtag
- Position: Inside Field (Left)

Issue Category
- Icon Class: list
- Position: Above Field

Priority
- Icon Class: exclamation-triangle
- Position: Above Field
- Color: #ff6b6b (red for urgency)

Description
- Icon Class: file-alt
- Position: Above Field
```

### 7. Newsletter Signup

Simple subscription form:

```
Email Address
- Icon Class: envelope
- Position: Inside Field (Left)
- Color: #0066cc
- Size: 18px

(Optional) Name
- Icon Class: user
- Position: In Placeholder
```

### 8. Job Application Form

Professional job submission:

```
Full Name
- Icon Class: user
- Position: Inside Field (Left)

Email
- Icon Class: envelope
- Position: Inside Field (Left)

Phone
- Icon Class: phone
- Position: Inside Field (Left)

LinkedIn Profile
- Icon Class: linkedin
- Icon Library: Font Awesome Brands
- Position: Inside Field (Left)
- Color: #0077b5 (LinkedIn blue)

Years of Experience
- Icon Class: briefcase
- Position: Inside Field (Left)

Current Position
- Icon Class: id-badge
- Position: Inside Field (Left)

Cover Letter
- Icon Class: file-text
- Position: Above Field
```

### 9. Feedback Form

Product/service feedback:

```
Your Name
- Icon Class: user
- Position: In Placeholder

Email
- Icon Class: envelope
- Position: In Placeholder

Rating
- Icon Class: star
- Position: Above Field
- Color: #ffd700 (gold)

Comments
- Icon Class: comments
- Position: Above Field
```

### 10. Address Form

Location/shipping details:

```
Street Address
- Icon Class: map-marker-alt
- Position: Inside Field (Left)
- Color: #dc3545 (red pin)

City
- Icon Class: city
- Position: Inside Field (Left)

State/Province
- Icon Class: map
- Position: Inside Field (Left)

ZIP/Postal Code
- Icon Class: mail-bulk
- Position: Inside Field (Left)

Country
- Icon Class: globe
- Position: Inside Field (Left)
```

## Creative Positioning Examples

### Mixed Positions in One Form

Create visual hierarchy by varying icon positions:

```
Form Title: "Get in Touch"

Name (Inside-Left) → Clean, modern look
Email (Inside-Left) → Consistent with name
Subject (Above) → Stands out more
Message (Above) → Draws attention to main field
```

### Color Coding for Field Types

Use colors to indicate field categories:

```
Personal Info (Blue icons)
- Name: user icon, #0066cc
- Email: envelope icon, #0066cc

Contact Details (Green icons)
- Phone: phone icon, #28a745
- Address: map-marker icon, #28a745

Account Security (Red icons)
- Password: lock icon, #dc3545
- Confirm: lock icon, #dc3545
```

### Size Variation for Emphasis

Adjust icon sizes for visual interest:

```
Primary fields: 18px icons
Secondary fields: 16px icons
Optional fields: 14px icons
```

## Pro Tips

### 1. Icon Selection Guide

Choose icons that are immediately recognizable:
- user/user-circle → Name fields
- envelope → Email
- phone/phone-alt → Phone
- lock → Password
- calendar/calendar-alt → Date
- clock → Time
- map-marker/map-pin → Location
- building → Company
- briefcase → Business/Job
- comment/comments → Messages
- search → Search fields
- heart → Favorites/Likes
- star → Ratings
- tag/tags → Categories

### 2. Color Psychology

- Blue (#0066cc): Trust, professional
- Green (#28a745): Success, positive
- Red (#dc3545): Required, urgent
- Orange (#fd7e14): Warning, attention
- Purple (#6f42c1): Creative, unique
- Gray (#6c757d): Neutral, optional

### 3. Position Best Practices

**Inside Left**
- Best for: Most input fields
- Why: Clean, modern, doesn't add height

**Inside Right**
- Best for: Confirmation fields, validation indicators
- Why: Different from primary fields

**Above Field**
- Best for: Textareas, important fields
- Why: More prominent, doesn't crowd input

**In Placeholder**
- Best for: Simple forms, minimal design
- Why: No extra elements, clean look

### 4. Accessibility Considerations

Always pair icons with:
- Clear labels (don't rely on icons alone)
- Good placeholder text
- Proper field types
- Adequate color contrast

### 5. Mobile Optimization

For mobile forms:
- Use slightly larger icons (18-20px)
- Prefer Inside-Left position (saves vertical space)
- Ensure adequate touch targets
- Test on actual devices

## Custom CSS Enhancements

### Add Icon Hover Effects

```css
.mbr-efi-icon {
    transition: all 0.3s ease;
}

.elementor-field-group:hover .mbr-efi-icon {
    transform: scale(1.1);
    color: #0066cc;
}
```

### Animate Icons on Focus

```css
.elementor-field:focus + .mbr-efi-icon {
    animation: pulse 0.5s;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}
```

### Style Required Field Icons

```css
.elementor-mark-required + .mbr-efi-icon {
    color: #dc3545;
}
```

### Add Background to Inside Icons

```css
.mbr-efi-field-wrapper .mbr-efi-icon {
    background: #f8f9fa;
    padding: 8px;
    border-radius: 4px;
}
```

## Testing Your Icons

Before finalizing your form:

1. **Preview on Multiple Devices**
   - Desktop (various resolutions)
   - Tablet (both orientations)
   - Mobile (various sizes)

2. **Test User Flow**
   - Tab through fields
   - Fill out the form
   - Check validation states

3. **Verify Icon Clarity**
   - Are icons recognizable?
   - Do they make sense?
   - Do they add value?

4. **Check Accessibility**
   - Screen reader friendly?
   - Keyboard navigable?
   - Color contrast adequate?

## Need More Ideas?

Browse Font Awesome's icon gallery for inspiration:
https://fontawesome.com/icons

Look for icons in these categories:
- Solid: Most versatile, best for forms
- Regular: Lighter weight, more elegant
- Brands: Social media, company logos

---

**Questions or Need Help?**
Visit: https://littlewebshack.com
