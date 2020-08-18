function filter(attr) {
   if($(attr).parent('div').children('p.delete.delete-field').attr( 'random-value-array'))  {
        delete filterCriteria[$(attr).parent('div').children('p.delete.delete-field').attr( 'random-value-array')];
    filterCriteria = filterCriteria.filter(function(e){return e});
    
   }
   
   console.log($(attr).val());
    $(attr).parent('div').next('div.user').css('display','none');
     $(attr).parent('div').next('div.user').next('div.profile').css('display','none');
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').css('display','none');
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').css('display','none');
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').css('display','none');
     $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').css('display','none');
     $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').css('display','none');
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').css('display','none');
          $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').css('display','none');
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').css('display','none');
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount').css('display','none');
     $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').css('display','none');
         
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').css('display','none');
         
          $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').css('display','none');
 
      $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').css('display','none');
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').css('display','none');
           
           $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').css('display','none');
         
 $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').next('div.safeListed').css('display','none');
$(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').next('div.safeListed').next('div.followBack').css('display','none');         
    
$(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').next('div.safeListed').next('div.followBack').next('div.lastActivity').css('display','none');         

    // @user
    if($(attr).val() == 'user') {
        
        $(attr).parent('div').next('div.user').css('display', 'block');
        }
    // profile image
    else if($(attr).val() == 'profileImage') {
        
        $(attr).parent('div').next('div.user').next('div.profile').css('display', 'block');
        }
    else if($(attr).val() == 'Name') {
        
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').css('display', 'block');
    }
    else if($(attr).val() == 'Bio') {
        
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').css('display', 'block');
    }
    else if($(attr).val() == 'Location') {
        
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').css('display', 'block');
    }
    else if($(attr).val() == 'lastTweeted') {
        
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').css('display', 'block');
    }
    else if($(attr).val() == 'followersCount') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').css('display','block');
    }
else if($(attr).val() == 'friendCount') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').css('display','block');
    }
    else if($(attr).val() == 'followRatio') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').css('display','block');
    }
        else if($(attr).val() == 'statusesCount') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').css('display','block');
    }
   
    else if($(attr).val() == 'listedCount') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount').css('display','block');
    }
        else if($(attr).val() == 'Protected') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').css('display','block');
    }
else if($(attr).val() == 'Verified') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').css('display','block');
    }    
    else if($(attr).val() == 'Language') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').css('display','block');
    }    
    
    else if($(attr).val() == 'memberSince') {
    
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').css('display','block');
    }    
        else if($(attr).val() == 'URL') {
        
         $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').css('display','block');
    }   
     else if($(attr).val() == 'friendorFollower') {
    
       $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').css('display','block');
    
    }   
    
    else if($(attr).val() == 'Safelisted') {
    
    $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').next('div.safeListed').css('display','block');
     } 
     else if($(attr).val() == 'followBack') {
            $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').next('div.safeListed').next('div.followBack').css('display','block');  
           
             } 
         
    else if($(attr).val() == 'lastActivity') {
    
        $(attr).parent('div').next('div.user').next('div.profile').next('div.name').next('div.bio').next('div.location').next('div.lastTweeted').next('div.followersCount').next('div.friendsCount').next('div.followratio').next('div.statusCount').next('div.listedCount')
         .next('div.protected').next('div.verified').next('div.language').next('div.memberSince').next('div.url').next('div.friendorfollower').next('div.safeListed').next('div.followBack').next('div.lastActivity').css('display','block');  
} 
}