<div class="auth-container">
    <div class="authorization">
        <div class="login-bottom-container">
            <h4>Member login</h4>
            <div class="form-group-login">
                <?php
                if ( ! is_user_logged_in() ) { // Display WordPress login form:
                    $args = array(
                        'redirect' => admin_url(),
                        'form_id' => 'loginform-custom',
                        'label_username' => __( '' ),
                        'label_password' => __( '' ),
                        'label_remember' => __( 'Remember Me' ),
                        'label_log_in' => __( 'Login' ),
                        'remember' => false
                    );
                    wp_login_form( $args );
                } else { // If logged in:

                    wp_loginout( home_url() ); // Display "Log Out" link.
                    echo " | ";
                    wp_register('', ''); // Display "Site Admin" link.
                }
                ?>
            </div>
        </div>
        <div class="subscribe-bottom-container">
            <h4>Subscribe to our weekly newsletter</h4>
            <div class="form-group-subscribe">
                <input type="email" class="email-input input" id="email" placeholder="Email address">
                <input type="submit" class="email-submit button button-primary" id="subscribe_btn" value="Subscribe">
            </div>

        </div>
        <?php if(!is_user_logged_in()){ ?>
        <div class="reg-container">
            <div class="registration row">
                <div class="reg-form">
                    <div>
                        <h4>Not a member yet</h4>
                    </div>
                    <div class="sign-up-ref">
                        <a href="<?php echo wp_registration_url()?>"><h4>Sing up Now</h4></a>
                    </div>
                </div>
                <div class="social-form">
                    <a href="#"><div style="background: url('<?php bloginfo('template_url') ?> /img/logo_f_45x45.jpg')"></div></a>
                    <a href="#"><div style="background: url('<?php bloginfo('template_url') ?> /img/logo_t_45x45.jpg')"></div></a>
                    <a href="#"><div style="background: url('<?php bloginfo('template_url') ?> /img/logo_i_45x45.jpg')"></div></a>
                </div>
            </div>
        </div>
        <?php }?>

    </div>
</div>

<div class="footer-container">
        <div class="footer row">
            <div class="col-sm-3 col-md-6 col-lg-3 ">
                <h5>About Us</h5>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
            </div>
            <div class="col-sm-3 col-md-6 col-lg-3">
                <h5>Proparties</h5>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
                <a href="#"><p>Lorem ipsum</p></a>
            </div>
            <div class="col-sm-3 col-md-6 col-lg-3">
                <h5>Costamer Testimonials</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam elementum velit lorem, nec consectetur tellus viverra a. Etiam ac dolor quis libero vestibulum bibendum at eget elit. Sed vehicula hendrerit.</p>
            </div>
            <div class="col-sm-3 col-md-6 col-lg-3">
                <h3>Realestate Company</h3>
                <p></p>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>