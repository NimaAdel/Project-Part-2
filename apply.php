<?php require_once 'header.inc'; ?>
  <section>
    <h2>Application Form</h2>
    <form action="process_eoi.php" method="post" novalidate>
      <fieldset class="applicant-info-fieldset">
        <Legend>Applicant Information</Legend>
        <label for="reference-number">Reference Number</label>
        <input
          class="selectable"
          type="text"
          name="reference-number"
          id="reference-number"
          pattern="[a-zA-Z0-9]{5}"
          placeholder="12345"
          required>

        <label for="first-name">First Name</label>
        <input
          class="selectable"
          type="text"
          name="first-name"
          id="first-name"
          pattern="[a-zA-Z]{1,20}"
          placeholder="John"
          required>

        <label for="last-name">Last Name</label>
        <input
          class="selectable"
          type="text"
          name="last-name"
          id="last-name"
          pattern="[a-zA-Z]{1,20}"
          placeholder="Smith"
          required>

        <label for="date-of-birth">Date of Birth</label>
        <input
          class="selectable"
          type="text"
          name="date-of-birth"
          id="date-of-birth"
          pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/\d{4}"
          placeholder="DD/MM/YYYY"
          required>

        <fieldset class="gender-fieldset">
          <legend>Gender</legend>
          <label for="male">Male</label>
          <input
            type="radio"
            name="gender"
            id="male"
            value="male"
            required>

          <label for="female">Female</label>
          <input
            type="radio"
            name="gender"
            id="female"
            value="female"
            required>

          <label for="non-binary">Non-Binary</label>
          <input
            type="radio"
            name="gender"
            id="non-binary"
            value="non-binary"
            required>

          <label for="other">Other</label>
          <input
            type="radio"
            name="gender"
            id="other"
            value="other"
            required>
        </fieldset>


        <label for="street-address">Street Address</label>
        <input
          type="text"
          class="selectable"
          name="street-address"
          id="street-address"
          pattern=".{1,40}"
          placeholder="123 Example Road"
          required>

        <label for="town">Town/Suburb</label>
        <input
          type="text"
          class="selectable"
          name="town"
          id="town"
          pattern=".{1,40}"
          placeholder="Example"
          required>

        <label for="state">State</label>
        <select class="selectable" name="state" id="state" required>
          <option value="">Please Select a state</option>
          <option value="VIC">VIC</option>
          <option value="NSW">NSW</option>
          <option value="QLD">QLD</option>
          <option value="NT">NT</option>
          <option value="WA">WA</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="ACT">ACT</option>
        </select>

        <label for="postcode">Postcode</label>
        <input
          type="text"
          class="selectable"
          name="postcode"
          id="postcode"
          pattern="[0-9]{4}"
          placeholder="1234"
          required>

        <label for="email">Email</label>
        <input
          type="email"
          class="selectable"
          name="email"
          id="email"
          placeholder="email@email.com"
          required>

        <label for="phone-number">Phone Number</label>
        <input
          type="text"
          class="selectable"
          name="phone-number"
          id="phone-number"
          pattern="[0-9]{8,12}"
          placeholder="0412 345 678"
          required>
      </fieldset>

      <fieldset>
        <legend>Skill List</legend>

        <div class="skill-group-standard">
          <label for="skill1">
            <input type="checkbox" name="obedient" id="skill1" />
            Strong Sense of Obedience
          </label>

          <label for="skill2">
            <input type="checkbox" name="ignorance" id="skill2" />
            General Ignorance
          </label>

          <label for="skill3">
            <input type="checkbox" name="social-lack" id="skill3" />
            Lack Of Social Interaction
          </label>

          <label for="skill4">
            <input type="checkbox" name="cursive" id="skill4" />
            Cursive
          </label>

          <label for="skill5">
            <input type="checkbox" name="document-signing" id="skill5" />
            Willingness to sign any document
          </label>
        </div>

        <div class="other-skills-control">
          <input type="checkbox" name="other-skills" id="other-skills" />
          <label for="other-skills">Other Skills</label>
          <div id="hidden">
            <label for="other-skills-long">What are your other skills?</label>
            <textarea
              class="selectable"
              name="other-skills-long"
              id="other-skills-long"
              placeholder="Type your other skills here"></textarea>
          </div>
        </div>
      </fieldset>
      <input class="button" type="submit" value="Submit">
      <input class="button" type="reset" value="Reset form">
    </form>
  </section>

<?php require_once 'footer.inc'; ?>