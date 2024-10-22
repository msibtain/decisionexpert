<?php    include('header.php'); ?>

<!--left-->
<?php    include('left.php');
  $result = "SELECT * FROM `tbl_country`";
$rows = $db->get_results($result);

 ?> 

<style type="text/css">
  body, td, th, div, p, label{
    font: normal 14px/22px Arial, Helvetica, sans-serif;
  }
</style> 
<div class="row">
  <div class="col-md-12">
      <table class="contentpaneopen">
        <tbody>
          <tr>
            <td colspan="2" class="article_indent" valign="top">
            <form action="register.process.php" method="post" name="register" onsubmit="javascript: return CheckMeFirst(this);">
                <table class="tbl_padding_3" id="reg_table">
                <tbody>
                    <tr>
                      <td width="23" valign="top" class="ar_fix_width">&nbsp;</td>
                      <td width="235" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top" class="ar_fix_width">Contact Name <span class="red">*</span></td>
                      <td valign="top"><input type="text" name="name" value="" class="width300 required grey name" required="required"></td>
                    </tr>
                    <tr>
                      <td valign="top">Organization</td>
                      <td valign="top"><input type="text" name="organisation" value="" class="width300 grey"></td>
                    </tr>
                    <tr>
                      <td valign="top">Phone</td>
                      <td valign="top">
                          <input type="text" name="phone" value="" class="width300 grey">
                          <br>
                          <small>format should be Internationl, for example, 00971XXXXXXXXX</small>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">Email <span class="red">*</span></td>
                      <td valign="top"><input type="email" name="email" value="" required="required" class="width300 required grey"></td>
                      <span id="email" class="text-danger"></span>
                    </tr>
                    <tr>
                      <td valign="top">Gender </td>
                      <td valign="top"><input type="radio" name="gender" checked="checked" value="Male">
                      Male<input type="radio" name="gender" value="Female">
                      Female</td>
                    </tr>
                    <tr>
                      <td valign="top">Country</td>
                      <td valign="top"><select name="country" id="country" style="color:#646464;" class="width300">
                        <option value="">--- Choose One ---</option>
                      <?php 
                        foreach($rows as $row)
                        {
                          ?>
                            <option value="<?php echo $row->country_Id ?>"><?php echo $row->country_name ?></option>
                          <?php
                        }
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">Password <span class="red">*</span></td>
                      <td valign="top"><input type="password" name="password" required class="width300 required grey" value="" len>
                      <input type="hidden" name="password_hidden" value="">  </td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;<input type="hidden" name="type" value="demo">
                      <input type="hidden" name="user_id" value="">  
                      </td>
                      <td valign="top">
                          <input type="submit" class="wide_button" name="submit" value="Register">
                          <input type="hidden" id="gcaptcha-token" name="gcaptcha-token" value="03AGdBq24vOcEaYJPkX9c8dHp5y-NZmhyMCgktamNX0WWK9arLBM-gD2wzj_abzgBqpHMdxJhrVLsDJpWf8O8f-Z_jm2Mu8Ci1kBfzln0XEiHkn-ue9uBs2q1Ev-dfVCNg9RDrynp49Yf3IYIVsIRDcs7eDHofcB2jh0pL7qat8Yo5bt93j_yflQNJ48MAmeSsVFPX819h-_vI9StZZyp0FEWx0yLbecgo8rY4s5mQSj82E4gqElE9BfHqB-vxoSC8dMEw3cI-yn0QS9ro3yh-TcP8RR4KmN6yoXKP_grtDHZ7Z4TE74ctb1YwzaX1bd7BW3HhBcvVB2_1AZTpEO9YKHagJtd3a_pnCA_zRRtxMVsm3_UViheeRn7bQl_wqhY3xhNw8C_6nkh03jpIl2rB-eawJaMS6RbVpdhR2sdSov6JllRaeiMVsRr600r3cPgp-YOSRyHJK8cT">
                          <input type="hidden" name="added_by" value="">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
              </td>
          </tr>
      </tbody>
    </table>
  </div>
</div>
<script language="javascript">

function CheckMeFirst(frm)

{

  var error = '';

  

  if (!frm.name.value)

    error += '<?=PLEASE_ENTER_NAME?>\n';

  
if (!frm.email.value)
  {
    if(!isEmail(frm.email.value)){
      jQuery("#email").html("Please enter a valid email like example@gmail.com");
      return false;
    }else{
      jQuery("#email").html("");
    }
    error += '<?=PLEASE_ENTER_EMAIL?>\n';
  }

  <?php    if (!$user_id) { ?>

  if (!frm.password.value)

    error += '<?=PLEASE_ENTER_PASSWORD?>\n';

  <?php    } ?>

  

  if (error)

  {
    return false;

  }

  

  return true;

}

</script>
<?php	 	 include('footer.php'); ?>