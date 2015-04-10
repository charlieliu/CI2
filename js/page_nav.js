function pagenav(pg){
    if( $("finder").val()!=''  ) var str = $("#"+$("finder").val()).serialize();
    console.log(str);
    if( str===undefined || str=='' )
        str = '' ;
    else
        str = '&' + str ;
    var postdata = 'page='+pg+str;
    //console.log(postdata);
    $.ajax({
        type: "POST",
        data: postdata,
        dataType: "json"
    }).done(function(response){
        if( response.status=='100' ){
            $('tbody').html( response.output ) ;
            $('#pageCnt').html( response.pageCnt ) ;
            $('#pageDropdown').html( response.dropdown ) ;
            $('#pageNow').html( response.pg ) ;
            $('#page').html( response.pg ) ;
        }else{
            alert( response );
            console.log('console.log(response.status)='+response.status);
            console.log('console.log(response)='+response);
        }
    });
};

function pgSelect(){
    $("span[name^='pageDropdown']>select").change(function(){
        var pg = parseInt( $(this).find("option:selected").val() ), pgcnt = parseInt( $('#pageCnt').html() );
        if( pg<=1 ) pg=1;
        if( pg>pgcnt ) pg=pgcnt ;
        pagenav(pg);
    });
};

function prev(){
    var pg = ( parseInt( $('#pageNow').html() )-1 );
    console.log(pg);
    if( pg<=1 ) pg=1;
    pagenav(pg);
};

function next(){
    var pg = ( parseInt( $('#pageNow').html() )+1 ), pgcnt = parseInt( $('#pageCnt').html() );
    if( pg>pgcnt ) pg=pgcnt ;
    pagenav(pg);
};

function pageinit(pg,pgcnt){
    if( pgcnt>1 ){
        if( pg==1 ){
            $(".prev-page").addClass("disable");
            $(".next-page").removeClass("disable");
        }else if( pg==pgcnt ){
            $(".prev-page").removeClass("disable");
            $(".next-page").addClass("disable");
        }else{
            $(".prev-page").removeClass("disable");
            $(".next-page").removeClass("disable");
        }
    }else{
        $(".prev-page").addClass("disable");
        $(".next-page").addClass("disable");
    }
};

$(document).ready(function(){
    $("<input>",{id:'finder',type:'hidden',val:''}).appendTo("body");
    pgSelect();
    pageinit(parseInt( $('#pageNow').html() ), parseInt( $('#pageCnt').html() ));
}).ajaxComplete(function(){
    pgSelect();
});