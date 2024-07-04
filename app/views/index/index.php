<!DOCTYPE html>
<html lang="fa"dir="rtl">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه اصلی </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
    <div class="motherdiv">

        <div class="right">

            <div class="header">
                <div class="userimg">
                    <img src="/app/views/index/imgg.jpeg" class="img" alt="">
                </div>
                <ul class="icon">
					<!-- add cotact -->
					<button id="plus">  <li><ion-icon name="add-circle"></ion-icon></li></button>
					<button id="btnrefresh">  <li><ion-icon name="refresh-circle"></ion-icon></li></button>
                </ul>
            </div>
       
           
            <div class="chatlist" >
            <ul style="color:red" id="lis"></ul>
                

            </div>
        </div>

        <div class="left">
            <div class="header">
                <div class="textimg">
                    <div class="userimg">
                    <img src="/app/views/index/imgg.jpeg" class="img" alt="">
                    </div>
                    <h4 id="hcontactname">reza <br> <span>onloin</span></h4>
                </div>
                
            </div>
            <div id="mes" class="messagebox">
                <div  class="messagee sel">
                    <p >hossein <br> <span>time</span></p>
                </div>

                <div  class="messagee get">
               
                </div>
            </div>

            <div class="chatbox">
                <button type="button" onclick="sending()" style="background-color: wheat;border-width:0;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                <input type="text" id="massageid" placeholder="message..." >
                <ion-icon name="happy-outline"></ion-icon>
                <ion-icon name="attach-outline"></ion-icon>
            </div>


        </div>  
        <div id="modal" style="display:none">
            <div class="content">
            <h2 class="h2-modal">Add Contact</h2>
            <form onsubmit="return false">
            <input type="text" placeholder="Name" id="name" class="contact">
            
            <input type="text" placeholder="Phone" id="phone" class="contact" maxlength="11">
            
            <button type="submit" id="add" class="contact">Add Contact</button>
            
            <span id="warning" style="color: red;display:none;">Massage Error</span>
            </form>
            </div>
        </div>
        <!-- modal edit -->
       
        <div id="editmodal" style="display:none">
            <div class="content">
            <h2 class="h2-modal">edit Contact</h2>
            <form onsubmit="return false">
            <input type="text" placeholder="NewName" id="editname" class="contact" require>
            
            <button type="submit" id="editid"  class="contact">edit Contact</button>
            
            <span id="editwarning" style="color: red;display:none;">Massage Error</span>
            </form>
            </div>
        </div>
<!-- //////removemassage///// -->
        <div id="removemodal" style="display:none">
            <div class="content">
            <h2 class="h2-modal">ویرایش یا حذف؟</h2>
            <form onsubmit="return false">
            
            <button type="submit" id="removeidedit"  class="contact">edit</button>
            <button type="submit" id="removeid"  class="contact">remove</button>
            <span id="editwarning" style="color: red;display:none;">Massage Error</span>
            </form>
            </div>
        </div>
        <!-- ///// -->
        <div id="editmassage" style="display:none">
            <div class="content">
            <h2 class="h2-modal"></h2>
            <form onsubmit="return false">
            <input type="textarea" placeholder="Newmassage" id="editmassageinput" class="contact" require>
            <button type="submit" id="editmassageid"  class="contact">ok</button>
            <span id="editwarning" style="color: red;display:none;">Massage Error</span>
            </form>
            </div>
        </div>
 
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="public/js/jquery-3.4.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  
   <script>
  
    

    var ref = document.getElementById('btnrefresh');

    function refresh() {
                          $.ajax({
                                        url: "<?= URL; ?>index/get_contact_data",
                                        type: "POST",
                                        data: {
                                            
                                        },
                                        success: function(response) {
                                            response = JSON.parse(response);
                                
                                            if (response.status_code == "600") {
                                                var d=response.msg 
                                                var na=[]
                                                var contactid=[]
                                            for(i=0;i<d.length;i++){
                                                
                                                na.push(d[i]['name']);
                                                contactid.push(d[i]['contact_id'])
                                                
                                                }
                                                    
                                                 var MyName = na;
                                                var result = document.getElementById("lis");
                                                var MyText = "";
                                                var i=0
                                                MyName.forEach(MyResult);
                                                result.innerHTML = MyText
                                                
                                               
                                                function MyResult(names){
                                                MyText = MyText + "<div class='lisbtn' style='background:#E6E6FA' onclick='nb("+contactid[i]+",\""+names+"\")'<button  ><li class='liedit' id="+contactid[i]+">"+ names + "<button onclick='updateData(\"" + contactid[i] +"\")' class='btnedit'>ویرایش کنید</button></li> </button></div>";
                                                i++;   } 
                                              
                                            
                       
                                            
                                            }
                                        },
                                        error: function(response) {
                                            alert("Error 500");
                                        }
                            });
                        }

 btnrefresh.onclick=refresh();

           ////// edit contact//////////////////
           var modaledit=document.getElementById('editmodal')
           var editid=document.getElementById('editid')
           var editname=document.getElementById('editname');
           var btnedit=document.getElementsByClassName('btnedit');
        
        /////////////
           var editwarning=document.getElementById('editwarning')
           editid.onclick= function editnamemodal(){
                var h= editname.value           
                $.ajax({
                            url: "<?= URL; ?>index/edit_data",
                            type: "POST",
                            data: {
                                "contactname": h
                                
                            }
                            ,
                            success: function(response) {
                                response = JSON.parse(response);
                                    if(response.status_code==302&&response.msg==1){
                                                refresh()
                                                modaledit.style.display ='none';
                                                editwarning.style.display ='none';
                                    }
                                    if (response.status_code==302&&response.msg==2){
                                            editwarning.style.display ='block';
                                            $("#editwarning").text("لطفا فیلد را پر کنید");
                                    }
                            }
                                ,
                            error: function(response) {
                                alert("Error 500");
                            }
                        })
            }
                    
                        
                    function updateData(id) {
                        event.stopPropagation();  
                        modaledit.style.display ='block';
                            // console.log(id)
                            
                        $.ajax({
                            url: "<?= URL; ?>index/edit_datan",
                            type: "POST",
                            data: {
                                "contactid": id
                                
                            },
                            success: function(response) {
                                response = JSON.parse(response);
                            },
                            error: function(response) {
                                alert("Error 500");
                            }        
                        })
                    }
                         
                        
                           
                                  
                          
                                      
                 
                  
                      
   ///////////////////////////////////////contact masage//////
   function sending(s){
                var text=$('#massageid').val();
 
         
                $.ajax({
                            url: "<?= URL; ?>index/contact_massage",
                            type: "POST",
                            data: {
                                "gettext":text
                     
                            
                            },
                            success: function(response) {
                                response = JSON.parse(response);
                                $("#mes").empty(); 
                                var t=''        
                                response.msg.forEach(function(i){
                                                   
                                         if(response.msg_2==i["SendID"]){
                                                                        
                                             $("#mes").append("<div class='messagee get' onclick='removem("+i['ID']+")'><p>"+i['Text']+" <span>"+i['Date _Send']+"</span></p> </div>");
                                       
                                        }else{
                                                               
                                            $("#mes").append("<div class='messagee sel' ><p>"+i['Text']+" <span>"+i['Date _Send']+"</span></p> </div>")

                                        }
                                                
                               })
                                               
                                               
                                                

                            },
                            error: function(response) {
                                alert("Error 500");
                            }        
                })   
    }
  
    function removem(id){
                            $("#removemodal").css("display","block")
                           
                            $.ajax({
                                    url: "<?= URL; ?>index/edit_massage",
                                    type: "POST",
                                    data: {
                                        "idm": id
                                        
                                        
                                    },
                                    success: function(response) {
                                        response = JSON.parse(response);
                                    },
                                    error: function(response) {
                                        alert("Error 500");
                                    }        
                            })
    }
    $("#editmassageid").click(function(){
                            event.stopPropagation();
                            x=$("#editmassageinput").val()
                           
                            $.ajax({
                                    url: "<?= URL; ?>index/edit_massage",
                                    type: "POST",
                                    data: {
                                       
                                        'newmassage': x
                                        
                                    },
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        $("#editmassage").css("display","none")
                                        $("#removemodal").css("display","none")
                                        t=response.msg[0]['GetID']
                                        refreshm(t)
                                    },
                                    error: function(response) {
                                        alert("Error  500");
                                    }        
                            })
    })
 
  
    $("#removeidedit").click(function(){
                     event.stopPropagation();
                     $("#editmassage").css("display","block") 
    }) 

   $("#removeid").click(function(){
                    console.log('remove')
                    $.ajax({
                                    url: "<?= URL; ?>index/edit_massage",
                                    type: "POST",
                                    data: {
                                       
                                       'remove': 8
                                        
                                    },
                                    success: function(response) {
                                        response = JSON.parse(response);
                                        // console.log('donnnnn')
                                        $("#removemodal").css("display","none")
                                       
                                        t=response.msg[0]['GetID']
                                        refreshm(t)
                                    },
                                    error: function(response) {
                                        alert("Error 500");
                                    }        
                            })

    }) 
    
    function refreshm(idm){
    
        $.ajax({
                            url: "<?= URL; ?>index/refresh_massage",
                            type: "POST",
                            data: {
                                "idm":idm
                     
                            
                            },
                            success: function(response) {
                                response = JSON.parse(response);
                                $("#mes").empty(); 
                                var t=''        
                                response.msg.forEach(function(i){
                                                   
                                                 if(response.msg_2==i["SendID"]){
                                                      
                                                           
                                                      $("#mes").append("<div class='messagee get' onclick='removem("+i['ID']+")'><p>"+i['Text']+" <span>"+i['Date _Send']+"</span></p> </div>");
                                                    

                                                 }
                                                 else{
                                                                  
                                                    $("#mes").append("<div class='messagee sel'><p>"+i['Text']+" <span>"+i['Date _Send']+"</span></p> </div>")

                                                 }
                                                
                                })
                                               
                                               
                                                

                            },
                            error: function(response) {
                                alert("Error 500");
                            }        
                }) 

    }   
     
   function nb(d,name){
                refreshm(d);
                $(".liedit").css('background','#E6E6FA')
                var liedit=document.getElementById(d)
                liedit.style.background='green';
                $("#hcontactname").text(name)
                
                $.ajax({
                            url: "<?= URL; ?>index/contact_massage",
                            type: "POST",
                            data: {
                                "getid":d
                     
                                
                            },
                            success: function(response) {
                                response = JSON.parse(response);
                            },
                            error: function(response) {
                                alert("Error 500");
                            }        
                })
             

            }
            
        
            

   //////////////////
          function Checkphone(inputuser){
    var user=/^(?:(?:(?:\\+?|00)(98))|(0))?((?:90|91|92|93|99)[0-9]{8})$/;
    if(inputuser.match(user)){
      return true
    }
    else{
      return false;
    }
  }
		
		var modal = document.getElementById('modal');
		var plus = document.getElementById('plus');
		var add = document.getElementById('add');
		plus.onclick = function() {
			modal.style.display = 'block';	
        	}

		add.onclick = function adding() {
			var contactName = document.getElementById("name").value;
			var contactPhone = document.getElementById("phone").value;
			var warning1 = document.getElementById("warning");
			if (contactName == "" || contactPhone == "") {
				warning1.style.display = "block";				
                $("#warning").text("Please Fill In All Fields");
			} else if (Checkphone(contactPhone) == false) {
				warning1.style.display = "block";	
                $("#warning").text("The Mobile Format Is Not Respected");
                			
			} else {
 
				$.ajax({
					url: "<?= URL; ?>index/contact_data",
					type: "POST",
					data: {
						"contactName": contactName,
						"contactPhone": contactPhone
					},
					success: function(response) {
						response = JSON.parse(response);
						if (response.status_code == "404") {
                           modal.style.display = "none";						
                            	alert("مخاطب حساب کاربری دراین برنامه ندارد");}
                        else if (response.status_code == "300")
                            {modal.style.display = "none";
                                alert('با حساب خودتان نمیتوانید وارد شوید')}
                        else if(response.status_code == "405") 
                        {modal.style.display = "none";
                                alert('مخاطب قبلا وارد شده است')}    
                        else {
							modal.style.display = "none";							
                             alert("Contact Added");
                             refresh();
						}
					},
					error: function(response) {
						alert("Error 500");
					}
				});
			}
		};

      
        

       
	</script>
    
       
    
</body>

<style>
    *{
    direction: rtl;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background:linear-gradient(#B1EA6A,#87FFB6,#6EE7FF,#FF9EF6) ;
    /* background: linear-gradient(#808080 0%,#808080 130px, #C0C0C0 130px,#C0C0C0 100px ); */
}
.liedit{
    background-color:#E6E6FA;
}

.motherdiv{
    position: relative;
    width: 1300px;
    max-width: 100%;
    height: calc(100vh - 40px);
    background: white;
    box-shadow: 0 1px 1px 0 rgba(0,0,0,0,0,06) , 0 2px 5px 0 rgba(0,0,0,0,0,06);
    display: flex;
    border: 1.2PX solid black;
    border-radius: 15px;

}

#modal {
  display: none;
  background-color: rgba(0, 0, 0, 0.3);
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1;
  border-radius: 15px;
}
#editmodal {
  display: none;
  background-color: rgba(0, 0, 0, 0.3);
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1;
  border-radius: 15px;
}
#removemodal {
  display: none;
  background-color: rgba(0, 0, 0, 0.3);
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1;
  border-radius: 15px;
}
#editmassage{
    display: none;
  background-color: rgba(0, 0, 0, 0.3);
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 2;
  border-radius: 15px;   
}
.h2-modal{
  color: blue;
  margin: 0;
  top: 2px;
  text-transform: uppercase;
  font-size: 500;
}
.content {
  border-radius: 15px;
  background-color:rgba(0,0,0,0.9);
  margin: 10% auto;
  width: 45%;
  border-radius: 10px;
  padding: 5%;
  text-align: center;
}
.contact {
  background: none;
  display: block;
  margin: 12px auto;
  text-align: center;
  border: 2px solid #3498db;
  padding: 14px 10px;
  width: 200px;
  outline: none;
  color: red;
  border-radius: 24px;
  transition: 0.25s;
  font-family:Verdana, Geneva, Tahoma, sans-serif;
}
.contact[type="text"]:focus{
  width:280px;
  border-color:#2ecc71;
}
.contact::hover{
  background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: #fff;
    border-radius: 24px;
    transition: 0.25s;
}
#add {
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #2ecc71;
  padding: 14px 40px;
  outline: none;
  color: #fff;
  border-radius: 24px;
  transition: 0.25s;
  cursor: pointer;
}
#add:hover {
  background: #2ecc71;
}
.motherdiv .right{
    position: relative;
    flex: 30%;
    background: white ;
    border-left: 1px solid rgba(0,0,0,0,0,2);
    border-radius: 15px;

}

.motherdiv .left{
    position: relative;
    flex: 70%;
    background: #F0F8FF ;
    border-radius: 15px;

}

.header{
    position: relative;
    width: 100%;
    height: 50px;
    background:#865DFF;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px;
    border-radius: 15px;
   

    
}
.userimg{
    position: relative;
    width: 40px;
    height: 40px;
    overflow: hidden;
    border-radius: 50%;
    background: wheat;
    cursor: pointer;

}

.img{
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;

}
.icon{
    display: flex;
}

.icon li{
    display: flex;
    list-style: none;
    cursor: pointer;
    /* color: red; */
    font-size: 1.5em;
    margin-left: 10px;
}
.chatlist{
    position: relative;
    height: calc(100% - 50px);
    overflow-y: auto;
    background: #F0FFF0;
    border-left: 1px solid gray;
    border-radius: 15px;

}
.chatlist .block{
   
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid rgba(0,0,0,0,0,06);
    cursor: pointer;
    background:#E6E6FA ;
    border-bottom: 1px solid #6495ED	;

}
li{
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid rgba(0,0,0,0,0,06);
    cursor: pointer;
    background:#E6E6FA ;
    border-bottom: 1px solid #6495ED	;  
    justify-content: space-between;

}
.chatlist .block:hover{
    background:#D3D3D3 ;
}




.chatlist .block .imgbox{
    position: relative;
    min-width: 45px;
    height: 45px;
    overflow: hidden;
    border-radius: 50%;
    margin-left: 10px;

}
.motherdiv .block .detalis{
    position: inherit;
    width: 100%;

}
.motherdiv .block .detalis .listhead{
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;

}
.motherdiv .block .detalis .listhead h4{
    font-size: 1.1em;
    font-weight: 600;
    color: black;
    padding-right: 10px;
}
.motherdiv .block .detalis .listhead .time{
    font-size: 0.75em;
    color: #aaa;

}
.message{
    display: flex;
    justify-content: space-between;
    align-items: center;

}
.message p {
    color: #aaa;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    font-size: 0.9em;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-right: 10px;


}
.message b{
    background: greenyellow;
    color: #fff;
    min-width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.75em;

}
.textimg{
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;

}
.textimg h4{
    font-weight: 500;
    line-height: 1.2em;
    margin-right: 15px;
}
.textimg h4 span{
    font-size: 0.8em;
    color: #555;
}
.messagebox{
    position: relative;
    width: 100%;
    height: calc(100% - 110px);
    padding: 50px;
    overflow-y: auto;
    background: #ccffff;

}
.messagee{
    position: relative;
    display: flex;
    width: 100%;
    margin: 5px 0;
    



}
.messagee p{
    position: relative;
    right: 0;
    text-align: right;
    max-width: 70%;
    padding: 12px;
    background: #ccccff;
    border-radius: 10px;
    font-size: 0.9em;
    overflow: hidden;

}
.messagee p::before{
    content: '';
    position: absolute;
    top: 0;
    left: -12px;
    width: 20px;
    height: 20px;
    background: linear-gradient(235deg,#77dd77 0%,#77dd77 50%, transparent 50%,transparent);
}
.messagee p span{
    display: block;
    margin-top: 5px;
    font-size: 0.85em;
    opacity: 0.5;

}
.sel{
    justify-content: flex-end;
}

.get{
    justify-content: flex-start;
}
.get p{
    background: #ffe4c4;
}
.get p::before{
    content: '';
    position: absolute;
    top: 0;
    right: -18px;
    width: 20px;
    height: 20px;
    background: linear-gradient(135deg, #00ff80 0%,#00ff80 50%, transparent 50%,transparent);
}
.chatbox{
    position: relative;
    width: 100%;
    height: 60px;
    background: wheat;
    padding: 15px;
    justify-content: space-between;
    align-items: center;
    display: flex;
    border-radius: 15px;

}
.chatbox ion-icon{
    cursor: pointer;
    font-size: 1.8em;
    color: #51585c;

    
}
.chatbox input{
    position: relative;
    width: 90%;
    margin:  20px;
    padding: 10px 20px;
    border: none;
    outline: none;
    border-radius: 30px;
    font-size: 1em;



}


</style>




</html>