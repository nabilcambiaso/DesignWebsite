<?php include "./master.php" ;nav(); ?>
<style> #img2:hover{transform:translate(100%,100%) scale(1.6);
  transition: 0.5s ease;}</style>
	<div id="mainBody" style="margin-top: 80px; ">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                       <ul class="breadcrumb">
						<li><a href="index.html">Home</a> <span class="divider">/</span></li>
						<li class="active">Design Details</li>
					   </ul>
                      </div>
                    </div>
					   <div class="row">
                           <div class="col-md-1"></div>
                           <div class="col-md-10">
                               <h3 style="color:#71C55D; font-weight:bold;" id="lblId">label</h3><br>
                           </div>
                           <div class="col-md-1"></div>
                       </div>
					   <div class="row">
                        <div class="col-md-1 col-lg-1"></div>
					  <div  class="col-md-10 col-lg-10">

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                              <div id="carosuelimg1" class="carousel-item active">
                                <!--img here -->
                              </div>
                              <div id="carosuelimg2" class="carousel-item">
                                  <!--img here-->
                              </div>
                              <div id="carosuelimg3" class="carousel-item">
                                  <!--img here-->
                              </div>
                           </div>
                              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                              </a>
                        </div>
                       </div>
                       <div class="col-md-1 col-lg-1"></div>
                      </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                          <div class="col-md-1" title="Like" style="cursor:pointer; ">
                           <a href="#" title="Like" ><i style="margin-bottom:-22px; " class="fa fa-heart"></i></a>
                             <!--likes Number Here -->
                           <div class="fa-layers-counter" id="counter" style="color:#FF797E; font-weight:bold;  margin-left:22px; margin-top:-22px;">12</div>
                           </div> 
                        </div>
						<div class="col-md-12">

							<hr class="soft" />
							<h4>contact Us</h4>
							<hr class="soft clr" />
                        </div>
				</div>
            </div>
            <!-- ======= Contact Section ======= -->
<section id="contact" class="padd-section">

<div class="container" data-aos="fade-up">
  <div class="section-title text-center">
    <h2>Contact</h2>
    <p class="separator">Contact Us About Anything, You will be Answered Directly To Your Email Adress. Welcome. </p>
  </div>

  <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">

    <div class="col-lg-3 col-md-4">

      <div class="info">
        <div>
          <i class="fa fa-map-marker"></i>
          <p>Ouarzazate, Maroc<br>BP 45000</p>
        </div>

        <div class="email">
          <i class="fa fa-envelope"></i>
          <p>benajimajda6@gmail.com</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p>+212 634 327 410</p>
        </div>
      </div>

      <div class="social-links">
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
      </div>

    </div>

    <div class="col-lg-5 col-md-8">
      <div class="form">
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
          <div class="form-group">
            <input type="text" name="name" class="form-control" id="fullName" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
            <div class="validate"></div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" id="fromEmail" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
            <div class="validate"></div>
          </div>
          <div class="form-group">
            <input type="number" class="form-control" name="phone" id="telephoneEmail" placeholder="Your Phone Number"  />
            <div class="validate"></div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="fromSubject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
            <div class="validate"></div>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" id="messageEmail" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
            <div class="validate"></div>
          </div>
          <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="button" onclick="sendMessages()">Send Message</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
</section><!-- End Contact Section -->

		</div>
	</div>
    <!-- MainBody End ============================= -->
  <?php footer(); ?>
<script src="javascriptFiles/details.js"></script>

    