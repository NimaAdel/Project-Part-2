<?php require_once 'header.inc'; ?>
<section>
  <h2>Application Form</h2>
  <form action="process_eoi.php" method="post">
    <fieldset class="applicant-info-fieldset">
      <Legend>Applicant Information</Legend>
      <label for="reference-number">Reference Number</label>
      <input
        class="selectable"
        type="text"
        name="reference-number"
        id="reference-number"
        placeholder="12345">

      <label for="first-name">First Name</label>
      <input
        class="selectable"
        type="text"
        name="first-name"
        id="first-name"
        placeholder="John">

      <label for="last-name">Last Name</label>
      <input
        class="selectable"
        type="text"
        name="last-name"
        id="last-name"
        placeholder="Smith">

      <label for="date-of-birth">Date of Birth</label>
      <input
        class="selectable"
        type="text"
        name="date-of-birth"
        id="date-of-birth"
        placeholder="DD/MM/YYYY">

      <fieldset class="gender-fieldset">
        <legend>Gender</legend>
        <label for="male">Male</label>
        <input
          type="radio"
          name="gender"
          id="male"
          value="male">

        <label for="female">Female</label>
        <input
          type="radio"
          name="gender"
          id="female"
          value="female">

        <label for="non-binary">Non-Binary</label>
        <input
          type="radio"
          name="gender"
          id="non-binary"
          value="non-binary">

        <label for="other">Other</label>
        <input
          type="radio"
          name="gender"
          id="other"
          value="other">
      </fieldset>


      <label for="street-address">Street Address</label>
      <input
        type="text"
        class="selectable"
        name="street-address"
        id="street-address"
        placeholder="123 Example Road">

      <label for="town">Town/Suburb</label>
      <input
        type="text"
        class="selectable"
        name="town"
        id="town"
        placeholder="Example">

      <label for="state">State</label>
      <select class="selectable" name="state" id="state">
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
        placeholder="1234">

      <label for="email">Email</label>
      <input type="text"
        class="selectable"
        name="email"
        id="email"
        placeholder="email@email.com">

      <label for="phone-number">Phone Number</label>
      <input
        type="text"
        class="selectable"
        name="phone-number"
        id="phone-number"
        placeholder="0412 345 678">
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