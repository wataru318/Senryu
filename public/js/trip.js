$('.delete_btn').click(function(){
if(!confirm('本当に削除しますか？')){
return false;
}else{
location.href = 'index.html';
}
});

$('.like_button').on('click', (event) => {
$(event.currentTarget).next().submit();
});

$('.like_button').on('click', () => {
    $ajax({
        url:"./default.blade.php",
        method:"post",
        data:{name:$('like').val()},
        success: function(data){
            console.log(data);
        },
        error:function(){
            alert('接続エラー');
        }
    });
});

