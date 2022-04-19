</div><!-- End of main-wrapper  -->
	
<div id="footer-wrap" class="is-clearfix">
	<footer id="footer" class="site-footer">
		<div id="footer-inner" class="site-footer-inner container">
			
			<div class="columns is-variable is-4 is-multiline">
				<div class="column is-4">
					<div class="widget widget-links">
						<h3 class="widget-title ">About Us</h3>
						<p>Niveshaay was born with the objective of providing a viable alternative to the highly
							Commission-Oriented, fixed fee generating finance industry. A decade ago, two young
							professionals started a small advisory for few friends &amp; family and started
							managing their money with just a simple expectation of getting a share in the
							returns, rather than a fat fixed fee.</p>
							<div class="btn-wrapper">
							   <a href="{{asset('images/investor-charter.pdf')}}" target="_blank" title="Invester Charter"
									class="btn btn-border-green">
									<em>
										<img src="{{asset('images/pdf.svg')}}" alt="Pdf icon">
									</em>
									Investor Charter
								</a>
							</div>
					</div>
				</div>
				<div class="column is-4">
					<div class="widget-links links-with-icons">
						<h3 class="widget-title ">Contact Us</h3>
						<ul>
							<li>
								<span class="icon"><i class="icon-location-pin"></i></span>
								<a href="https://www.google.com/maps/place/Nivesh+Shiksha/@21.1417755,72.7687535,17z/data=!3m1!4b1!4m5!3m4!1s0x3be05357064d63c7:0x204512c6b04261d8!8m2!3d21.1417755!4d72.7709422"
									target="_blank">508, SNS Platina, Near Someshwara Enclave, Vesu</a>
							</li>
							<li>
								<span class="icon"><i class="icon-envelope"></i></span>
								<a href="mailto:info@niveshaay.com">info@niveshaay.com</a>
							</li>
							<li>
								<span class="icon"><i class="icon-phone"></i></span>
								<a href="tel:918200384930">(+91) 8200384930</a>
							</li>
							<li>
								<span class="icon"><i class="icon-phone"></i></span>
								<a href="tel:917990746384">(+91) 7990746384</a>
							</li>
						</ul>
						<div class="textwidget" style="margin-top: 20px;">
							<h3 class="widget-title ">follow us</h3>
							<div class="footer-social-links">
								<ul>
									<li>
										<a href="https://www.facebook.com/niveshaay/" target="_blank"
											title="Facebook"><span class="icon"><i
													class="fab fa-facebook-f"></i></span></a>
									</li>
									<li>
										<a href="https://twitter.com/niveshaay" target="_blank"
											title="Twitter"><span class="icon"><i
													class="fab fa-twitter"></i></span></a>
									</li>
									<li>
										<a href="https://www.instagram.com/niveshaay/?hl=en" title="Instagram"
											target="_blank"><span class="icon"><i
													class="fab fa-instagram"></i></span></a>
									</li>
									<li>
										<a href="https://www.linkedin.com/company/14391848" title="Linkedin"
											target="_blank"><span class="icon"><i
													class="fab fa-linkedin"></i></span></a>
									</li>
									<li>
										<a href="https://www.youtube.com/channel/UC8vnjpKi6JhsBLKr6zovAHQ" target="_blank" title="Youtube"><span class="icon"><i
													class="fab fa-youtube"></i></span></a>
									</li>
								</ul>
							</div>
						</div>

					</div>
				</div>
				<div class="column is-4">
					<div class="widget widget-form">
						<h3 class="widget-title ">Watch Video</h3>
						<iframe width="100%" height="225" style="max-width:100%;max-height:100%;"
							data-src="{{url('https://www.youtube.com/embed/EgDqm9H1T0s')}}" allowfullscreen></iframe>
					</div>
				</div>
			</div>
			
		</div>
	</footer>
</div>
<div id="footer-bottom-wrap" class="is-clearfix footer-niveshay-copyright">
	<div id="footer-bottom" class="site-footer-bottom">
		<div id="footer-bottom-inner" class="site-footer-bottom-inner ">
			<section class="section footer-bottom-content">
				<div class="container">
					<!-- <h2 class="display-none">footer</h2> -->
					<span class="footer-copyright"><a href='https://niveshaay.com/'>Niveshaay</a> © <span
							class='current-year'></span>. All Rights Reserved.</span>
				</div>
			</section>
		</div>
	</div>
</div>
<script defer type="text/javascript" src="{{asset('/js/jquery.min.js')}}"></script>
<script defer type="text/javascript" src="{{asset('/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script defer type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script defer type="text/javascript" src="{{asset('/js/slick.min.js')}}"></script>
<script defer type="text/javascript" src="{{asset('/js/aos.js')}}"></script>
<script defer type="text/javascript" src="{{asset('/js/general.js')}}"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="module">
	
		jQuery('#login-modal form').submit(function(e){
			e.preventDefault();
			jQuery.ajax({
				url: "{{ route('login') }}",
				type:"POST",
				
				data:jQuery('#login-modal form').serialize(),
				success:function(data) {
					
					if(data.success == 1){
						window.location.href = "{{ route('frontend.share-detail') }}";
					}else{
						if(data.message.email){
							jQuery('#login-modal-email-error').html(data.message.email[0]);
						}else if(data.message.password){
							jQuery('#login-modal-error').html(data.message.password[0]);
						}else{
							jQuery('#login-modal-error').html(data.message);
						}
						
					}
						
				
				},
				error:function(res){
				console.log(res.status);
				}
			});
		});
		@if (Auth::user())
		jQuery('#edit-profile-form').submit(function(e){
			e.preventDefault();
			
			jQuery.ajax({
				url: "{{ route('frontend.editprofile') }}",
				type:"POST",
				headers: {
        			'X-CSRF-TOKEN': '{{ csrf_token() }}'
    			},
				data:new FormData( $( 'form#edit-profile-form' )[ 0 ] ),
				success:function(data) {
					if(data.success == 1){
						// jQuery('body,html').removeClass('open-modal');
            			// jQuery('#edit-profile-popup').closest('.custom-modal').removeClass('visible');
						window.location.reload();
						// toastr.options = {
    					// 	positionClass: 'toast-top-center'
  						// };
						// toastr.success("Profile Update Successfully");
					}
					else{
						if(data.message.email){
							jQuery('#profile-modal-email-error').html(data.message.email[0]);
						}else if(data.message.name){
							jQuery('#profile-modal-name-error').html(data.message.name[0]);
						}else if(data.message.phone_no){
							jQuery('#profile-modal-name-error').html(data.message.phone_no[0]);
						} else{
							jQuery('#profile-modal-email-error').html(data.message);
						}
					}
						
				
				},
				error:function(res){
					console.log(res.status);
				},
				enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false
			});
		});
		@endif
	
</script>
@stack('js')
<script>
    function init() {
        var vidDefer = document.getElementsByTagName('iframe');
        for (var i = 0; i < vidDefer.length; i++) {
            if (vidDefer[i].getAttribute('data-src')) {
                vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
            }
        }
    }
    window.onload = init;
</script>

</body>

</html>
