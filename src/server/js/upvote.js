function upvote(myID){
$.ajax({
  type:"POST",//or POST
  url:'upvote.php',

  data:{postID:myID},
  //can use dataType:'text/html' or 'json' if response type expected 
  success:function(data){
    // process on data
    console.log(data);
    let votecount = ("#" + "votecount" + myID);
    $(votecount).html(data);
    // var users = data.online_users;
  }
 });
}

function downvote(myID){
  $.ajax({
    type:"POST",//or POST
    url:'downvote.php',
  
    data:{postID:myID},
    //can use dataType:'text/html' or 'json' if response type expected 
    success:function(data, elem){
      // process on data
      console.log(data);
      let votecount = ("#" + "votecount" + myID);
      $(votecount).html(data);
    }
   });
  }