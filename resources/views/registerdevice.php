<html>
   <head>
      <title>Form register device</title>
   </head>
   <body>     
      <p>Register a new device: post data to table: devices</p>
      <form action = "registerdevice" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">     
         <table>
            <tr>
               <td>Id</td>
               <td><input type = "text" name = "id" /></td>
            </tr>
            <tr>
               <td>d_serial_number</td>
               <td><input type = "text" name = "d_serial_number" /></td>
            </tr>
            <tr>
               <td>d_brand</td>
               <td><input type = "text" name = "d_brand" /></td>
            </tr>						      
            
			<tr>
               <td colspan = "2" align = "center">
                  <input type = "submit" value = "Register" />
               </td>
            </tr>
         </table>         
      </form>
   </body>
</html>

