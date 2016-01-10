<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue</h1>
            <div class="account-wall">
                <center><i class="fa fa-user fa-5x login-icon"></i></center>
                <form class="form-signin" id="login-form">
                <input type="text" class="form-control" placeholder="Email" name="username" autofocus>
                <input type="password" class="form-control" placeholder="Password" name="password">
                <p class="text-center" id="message"></p>
                <button class="btn btn-lg btn-primary btn-block sign-in" type="submit" id="btn">Sign in</button>
                <a href="#" class="pull-right need-help">Forgot password? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="<?=site_url('register')?>" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>
<style type="text/css">
    .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
.login-icon
{
    padding: 10px;
    color:#999;
}
.sign-in
{
    border-radius: 3px;
    background: #215390;
    font-weight: 500;
}
#message
{
    font-size: 15px;
}
</style>
<script type="text/javascript">
    $('#login-form').submit(function()
    {
        $('#message').html('<center><i class="fa fa-spinner fa-spin"></i></center>');
        $.post("<?=site_url()?>welcome/get_login",$(this).serializeArray(),function(data){
            if(data.error == 0)
            {
                swal(data.message, "Redirecting please wait", "success");
                document.getElementById("login-form").reset();
                window.location = data.redir;
            }
            else if(data.error == 1)
            {
                $('#message').html("<p class='text-danger'>"+data.message+"</p>");
            }
            else
            {
                $('#message').html(data);
            }
        });
        return false;
    });
</script>