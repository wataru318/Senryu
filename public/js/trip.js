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

function success(pos) {
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;
    $('.location').text(`緯度:${lat} 経度:${lng}で詠まれました`);
}

function fail(error) {
    alert('位置情報の取得に失敗しました。');
}

navigator.geolocation.getCurrentPosition(success, fail);