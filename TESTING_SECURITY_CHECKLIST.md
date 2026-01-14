# ✅ Testing Checklist - Security Features

**Version**: 1.0  
**Date**: 13 Januari 2026

---

## 🧪 Pre-Setup Testing

### ☐ Environment Check
- [ ] PHP version >= 8.1
- [ ] Composer dependencies installed
- [ ] GuzzleHttp package available
- [ ] Database connection working
- [ ] `.env` file exists and readable

### ☐ File Check
- [ ] `resources/views/auth/login.blade.php` updated
- [ ] `app/Http/Requests/Auth/LoginRequest.php` updated
- [ ] `.env` file has RECAPTCHA keys (can be dummy for now)

---

## 🔑 reCAPTCHA Setup Testing

### ☐ Create reCAPTCHA Project
- [ ] Visit https://www.google.com/recaptcha/admin
- [ ] Create new project with v3 type
- [ ] Add domains: `localhost`, `127.0.0.1`
- [ ] Copy Site Key
- [ ] Copy Secret Key
- [ ] Update `.env` with actual keys

### ☐ Verify Keys Format
- [ ] RECAPTCHA_SITE_KEY is not empty
- [ ] RECAPTCHA_SECRET_KEY is not empty
- [ ] Keys are in proper format (mix of letters/numbers)
- [ ] No quotes in `.env` values

---

## 🏃 Runtime Testing

### ☐ Start Application
```bash
php artisan serve
```
- [ ] Server running on http://localhost:8000
- [ ] No PHP errors in console
- [ ] No Laravel errors in logs

### ☐ Access Login Page
- [ ] Navigate to http://localhost:8000/login
- [ ] Page loads without JavaScript errors
- [ ] CSS styling applied correctly
- [ ] All form elements visible

---

## 📝 Form Fields Testing

### ☐ Email Field
- [ ] Placeholder visible
- [ ] Can type email address
- [ ] Email validation on submit
- [ ] Error message for invalid email format
- [ ] Old value persists on error

### ☐ Password Field
- [ ] Text is hidden by default (****)
- [ ] Eye icon visible and clickable
- [ ] Clicking eye toggles visibility
- [ ] Icon changes (eye ↔ eye-slash)
- [ ] Required validation works

### ☐ Password Confirmation Field
- [ ] Label shows "Konfirmasi Kata Sandi"
- [ ] Text is hidden by default (****)
- [ ] Eye icon works independently
- [ ] Both eye icons can toggle independently
- [ ] Help text "Kata sandi harus sama" visible
- [ ] Field shows error when doesn't match
- [ ] Field shows success (green checkmark) when matches

### ☐ Password Matching Validation
- [ ] Type password: `Test123!`
- [ ] Type confirmation: `Test123` (different)
- [ ] Field turns red (is-invalid class)
- [ ] Type confirmation: `Test123!` (same)
- [ ] Field turns green (is-valid class)
- [ ] Submit button enabled

### ☐ reCAPTCHA Element
- [ ] Badge visible in bottom right corner
- [ ] Badge shows "reCAPTCHA"
- [ ] Badge links to reCAPTCHA privacy/terms
- [ ] No JavaScript console errors
- [ ] Network tab shows request to Google API

### ☐ Terms & Conditions Checkbox
- [ ] Checkbox visible and unchecked by default
- [ ] Label text: "Saya menyetujui..."
- [ ] Links to "Kebijakan Privasi" visible
- [ ] Links to "Syarat & Ketentuan" visible
- [ ] Links are clickable (target="_blank")

### ☐ Login Button
- [ ] Button shows "Login"
- [ ] Button is DISABLED initially (opacity reduced)
- [ ] Button becomes ENABLED when checkbox checked
- [ ] Button becomes DISABLED when checkbox unchecked
- [ ] Button styling visible (blue color)
- [ ] Hover effect visible

---

## 🔐 Validation Testing

### Test Case 1: Empty Fields
| Field | Value | Expected | Result |
|-------|-------|----------|--------|
| Email | [empty] | Error: "required" | ☐ |
| Password | [empty] | Error: "required" | ☐ |
| Confirm | [empty] | Error: "required" | ☐ |
| Terms | [unchecked] | Button disabled | ☐ |

### Test Case 2: Invalid Format
| Field | Value | Expected | Result |
|-------|-------|----------|--------|
| Email | `abc` | Error: "invalid email" | ☐ |
| Email | `abc@` | Error: "invalid email" | ☐ |
| Email | `@domain.com` | Error: "invalid email" | ☐ |

### Test Case 3: Password Mismatch
```
Password:           Test123!
Confirmation:       Test123
Expected Result:    Field turns red, error message
Your Result:        ☐
```

### Test Case 4: Password Match
```
Password:           Test123!
Confirmation:       Test123!
Expected Result:    Field turns green, can submit
Your Result:        ☐
```

### Test Case 5: Terms Not Accepted
```
Password:           Test123!
Confirmation:       Test123!
Terms Checkbox:     [unchecked]
Expected Result:    Login button disabled
Your Result:        ☐
```

### Test Case 6: All Valid
```
Email:              test@example.com
Password:           Test123!
Confirmation:       Test123!
Terms Checkbox:     [checked]
Expected Result:    Login button enabled, can submit
Your Result:        ☐
```

---

## 🤖 reCAPTCHA Verification Testing

### ☐ reCAPTCHA Token Generation
- [ ] Complete form with valid data
- [ ] Check Network tab (F12 > Network)
- [ ] Look for requests to `google.com/recaptcha`
- [ ] Token is generated automatically
- [ ] Token sent with form submission

### ☐ reCAPTCHA Verification Success
- [ ] Submit form with all valid data
- [ ] Wait for server response
- [ ] Check for reCAPTCHA success/failure
- [ ] If successful: redirect to dashboard/next page
- [ ] Check console for no errors

### ☐ reCAPTCHA Failure Handling
```
Scenario: Invalid reCAPTCHA token
Expected: Error message shown, stay on login page
Your Result: ☐

Scenario: Score too low (bot detected)
Expected: Error message "Verifikasi keamanan gagal"
Your Result: ☐

Scenario: Network error during verification
Expected: Error message "Terjadi kesalahan..."
Your Result: ☐
```

---

## 📱 Responsive Design Testing

### ☐ Desktop (1920x1080)
- [ ] All elements visible
- [ ] Form centered properly
- [ ] Eye icons clickable
- [ ] reCAPTCHA badge visible
- [ ] No layout breaks

### ☐ Tablet (768x1024)
- [ ] Form responsive
- [ ] Touch targets large enough
- [ ] Password fields still usable
- [ ] Checkbox easily clickable
- [ ] Badge positioned correctly

### ☐ Mobile (375x667)
- [ ] Form full width with padding
- [ ] No horizontal scroll
- [ ] Eye icons easy to tap
- [ ] Keyboard doesn't cover fields
- [ ] All text readable
- [ ] Badge not covering content

---

## 🧠 User Experience Testing

### ☐ Password Visibility Toggle
```
Action: Click password eye icon
Result: Text becomes visible
Action: Click again
Result: Text hidden again
Repeat 3x: ☐ Works every time
```

### ☐ Confirmation Password Toggle
```
Same as password field above
Result: ☐ Independent from password field
```

### ☐ Form Reset Behavior
```
Action: Fill form with data
Action: Refresh page (F5)
Result: Email value persists (old('email'))
Result: Password fields are empty (security)
Result: Checkbox is unchecked
Result: Button is disabled
Your Result: ☐
```

### ☐ Error Message Display
```
Action: Submit invalid email
Result: Alert box shows with red background
Result: Error message in Bahasa Indonesia
Result: User can read and understand
Your Result: ☐
```

---

## 🔄 Multiple Attempts Testing

### ☐ Retry After Error
```
Attempt 1: Wrong password
Result: Error message shown
Attempt 2: Correct credentials
Result: Login successful
Your Result: ☐
```

### ☐ Rate Limiting
```
Attempt 1: Wrong password → Error
Attempt 2: Wrong password → Error
Attempt 3: Wrong password → Error
Attempt 4: Wrong password → Error
Attempt 5: Wrong password → Error
Attempt 6: (Any credentials) → "Too many attempts" error
Your Result: ☐
```

---

## 🔐 Security Testing

### ☐ Password Field Security
- [ ] Password never logged in network
- [ ] Password never shown in URL
- [ ] Password masked in input field
- [ ] Password not visible in page source

### ☐ reCAPTCHA Token
- [ ] Token is sent via POST (not GET)
- [ ] Token not visible in URL
- [ ] Token changes on each request
- [ ] Expired tokens rejected

### ☐ Session Security
```
Action: Login successfully
Result: Session created
Result: Session ID in cookies
Result: Session regenerated after login
Your Result: ☐
```

---

## 💾 Database Testing

### ☐ Login Logging
- [ ] Check `logs` table for login attempts
- [ ] Verify IP address recorded
- [ ] Verify timestamp correct
- [ ] Verify user_id correct on success

### ☐ User Session
- [ ] User model loaded correctly
- [ ] Role attribute accessible
- [ ] Permissions working
- [ ] Logout clears session

---

## 📊 Browser Console Testing

### ☐ No JavaScript Errors
```bash
Open: http://localhost:8000/login
Press: F12 (Developer Tools)
Check Console tab
Expected: No red errors
Your Result: ☐
```

### ☐ Network Requests
```
Expected requests:
☐ GET /login (HTML page)
☐ GET /css (Bootstrap & custom CSS)
☐ GET /js (JavaScript)
☐ POST google.com/recaptcha (reCAPTCHA API)

No expected:
☐ 404 errors
☐ 500 errors
☐ Failed requests
```

---

## 🚀 Performance Testing

### ☐ Page Load Time
```
Target: < 2 seconds
Your Result: ___ seconds
Status: ☐ Pass / ☐ Fail
```

### ☐ reCAPTCHA Load Time
```
Target: < 1 second
Your Result: ___ seconds
Status: ☐ Pass / ☐ Fail
```

### ☐ Login Submit Time
```
Target: < 3 seconds
Your Result: ___ seconds
Status: ☐ Pass / ☐ Fail
```

---

## 📋 Sign-Off Checklist

### All Tests Passed?
- [ ] ✅ Pre-Setup Tests
- [ ] ✅ reCAPTCHA Setup Tests
- [ ] ✅ Runtime Tests
- [ ] ✅ Form Fields Tests
- [ ] ✅ Validation Tests
- [ ] ✅ reCAPTCHA Verification Tests
- [ ] ✅ Responsive Design Tests
- [ ] ✅ UX Tests
- [ ] ✅ Security Tests
- [ ] ✅ Performance Tests

### Ready for Production?
- [ ] All tests documented and passed
- [ ] No console errors
- [ ] No security issues
- [ ] Performance acceptable
- [ ] Documentation complete
- [ ] Team approval obtained

---

## 📝 Notes & Issues Found

```
Issue #1: ___________________________
Status: ☐ Resolved / ☐ Pending
Action: ___________________________

Issue #2: ___________________________
Status: ☐ Resolved / ☐ Pending
Action: ___________________________

Issue #3: ___________________________
Status: ☐ Resolved / ☐ Pending
Action: ___________________________
```

---

## ✍️ Test Report

**Tester Name**: ________________________  
**Date**: ________________________  
**Time Spent**: ________________________  
**Overall Status**: ☐ PASS / ☐ FAIL  
**Ready for Production**: ☐ YES / ☐ NO  

**Signature**: ________________________

---

**Generated**: 13 Januari 2026  
**Version**: 1.0
