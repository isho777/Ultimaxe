<html>
   <head>
      <title>Request login token</title>
   </head>
   <body>     
      <p>Request for login token</p>
      <form action = "requesttoken" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">     
         <table>        				                 
			<tr>
               <td colspan = "2" align = "center">
                  <input type = "submit" value = "Get login token" />
               </td>
            </tr>
         </table>         
      </form>
   </body>
</html>

