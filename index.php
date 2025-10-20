<?php $body_class = "home_page";
require_once 'header.inc'; ?>
<!--internal/embedded styling to make the background colour blue-->
<style>
  .home {
    background-color: #004b99;
  }
</style>

<!-- image reference -->
<!-- created by DeepAi, owned by DeepAi. prompts used - computer science students, holding laptops, very
  very happy, chains around their ankles - https://deepai.org -->

<section class="home" style="background-color: #004b99;">
  <figure>
    <div class="home_image">
      <img id="happy_students" src="images/happy_students_pic.jpg"
        alt="really happy students not forced to take the photo and they definitely arent in labour camps">
      <section id="text">
        <div class="centered">
          <h3>Donate to The Charity</h3>
          <p>the time to give is now. feel better about yourself. give us money</p>
        </div>
      </section>
    </div>
  </figure>

  <!-- This is the new white_box specifically for the revealed text -->
  <div class="white_box">
    <div id="revealed">
      <p id="caption">created by DeepAi, owned by DeepAi. prompts used - computer science students, holding laptops,
        very
        very happy, chains around their ankles - <a href="https://deepai.org">https://deepai.org</a> </p>
    </div>
  </div>

  <!-- This is the original white_box for the mission -->
  <div class="white_box">
    <h2 id="mission">
      Our Mission
    </h2>
    <p id="mission_text">One in ten computer science students in Victoria begin their first semester without access to
      a personal laptop. This lack of ownership can limit opportunities for self-expression and independence,
      potentially contributing to increased stress and early mental health challenges.

      <br>
      Our mission is to equip the next generation with the tools they need to shape the world and themselves,
      ultimately improving the lives of all.
      <br>
      When you donate to The Charity, you're giving a student the chance to truly experience university life. And with
      a gift like that, you're definitely earning some good karma. :D
    </p>
  </div>

  <!-- This is the original white_box for donation instructions -->
  <div class="white_box">
    <h2 id="donate"> How to donate</h2>
    <!-- inline css used for p -->
    <p style="color: #004b99;" id="donate_p">
      click the button below to be redirected to The Charity's offical banking page
    </p>
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">
      <img id="donate_button" src="images/donate_button.png" alt="blue button with the words Donate written">
    </a>
  </div>

</section>

<?php require_once 'footer.inc'; ?>