<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospitality Registration Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h1>Hospitality Registration Form</h1>

        <form action="#" method="post">
            <!-- Personal Information Section -->
            <fieldset>
                <legend>Personal Information</legend>
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full-name" required>

                <label>Gender:</label>
                <label for="male">
                    <input type="radio" id="male" name="gender" value="male"> Male
                </label>
                <label for="female">
                    <input type="radio" id="female" name="gender" value="female"> Female
                </label>
                <label for="non-binary">
                    <input type="radio" id="non-binary" name="gender" value="non-binary"> Non-Binary
                </label>
                <label for="other">
                    <input type="radio" id="other" name="gender" value="other"> Other
                </label>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </fieldset>

            <!-- Accommodation Preferences Section -->
            <fieldset>
                <legend>Accommodation Preferences</legend>
                <label for="check-in">Preferred Check-in Date:</label>
                <input type="date" id="check-in" name="check-in" required>

                <label for="check-out">Preferred Check-out Date:</label>
                <input type="date" id="check-out" name="check-out" required>

                <label>Room Type:</label>
                <select id="room-type" name="room-type" required>
                    <option value="single">Single Room</option>
                    <option value="double">Double Room</option>
                    <option value="suite">Suite</option>
                    <option value="other">Other</option>
                </select>

                <label for="special-requests">Special Requests or Preferences:</label>
                <textarea id="special-requests" name="special-requests"></textarea>
            </fieldset>

            <!-- Event Attendance Section -->
            <fieldset>
                <legend>Event Attendance</legend>
                <label for="attending-event">Will you be attending the event?</label>
                <select id="attending-event" name="attending-event" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>

                <label for="sessions">If yes, which sessions will you attend?</label>
                <textarea id="sessions" name="sessions"></textarea>
            </fieldset>

            <!-- Emergency Contact Section -->
            <fieldset>
                <legend>Emergency Contact Information</legend>
                <label for="emergency-contact-name">Emergency Contact Name:</label>
                <input type="text" id="emergency-contact-name" name="emergency-contact-name" required>

                <label for="relationship">Relationship to Attendee:</label>
                <input type="text" id="relationship" name="relationship" required>

                <label for="emergency-contact-phone">Emergency Contact Phone Number:</label>
                <input type="tel" id="emergency-contact-phone" name="emergency-contact-phone" required>
            </fieldset>

            <!-- Additional Information Section -->
            <fieldset>
                <legend>Additional Information</legend>
                <label for="how-heard">How did you hear about this event?</label>
                <select id="how-heard" name="how-heard" required>
                    <option value="social-media">Social Media</option>
                    <option value="email-invitation">Email Invitation</option>
                    <option value="website">Website</option>
                    <option value="word-of-mouth">Word of Mouth</option>
                    <option value="other">Other</option>
                </select>

                <label for="comments">Do you have any other comments or requests?</label>
                <textarea id="comments" name="comments"></textarea>
            </fieldset>

            <!-- Terms and Conditions Section -->
            <fieldset>
                <legend>Terms and Conditions</legend>
                <label for="terms">
                    <input type="checkbox" id="terms" name="terms" required> I agree to the terms and conditions of the event.
                </label>
                <label for="communications">
                    <input type="checkbox" id="communications" name="communications" required> I consent to receiving future communications related to the event.
                </label>
            </fieldset>

            <button type="submit">Submit Registration</button>
        </form>
    </div>

</body>
</html>
