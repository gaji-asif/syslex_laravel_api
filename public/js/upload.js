
function send(name,actionurl,root){

//ajaxでのcsrfトークン送信
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


    var extension = $('#'+name+"_file").val().split('.').pop().toLowerCase();
    if (actionurl.indexOf("banner") > 0){
    	if ($.inArray(extension, ['jpg', 'jpeg','png', 'gif','bmp','pdf']) == -1) {
            alert('有効な写真を選択してください... ');
            return;
        }
    }else{
        if ($.inArray(extension, ['jpg', 'jpeg','png', 'gif','bmp']) == -1) {
            alert('有効な写真を選択してください... ');
            return;
        }
    }
    //テキストの入力値を取得する。
    var textData = $('#'+name).val();
    //アップロードファイルの入力値を取得する。
    var fileData = $('#'+name+"_file").prop('files')[0];

    //フォームデータを作成する。(送信するデータ)
    var form = new FormData();

    //フォームデータにテキストの内容、アップロードファイルの内容を格納する。
    form.append( 'targetName', name );
    form.append( name, textData );
    form.append( name+"_file", fileData );
    //ポスト送信する。
    $.ajax({
        type: 'post',
        url: actionurl,
        data: form,
        processData : false,
        contentType : false,

        //成功の場合、以下を行う。
        success: function(data){
            $('#'+name).val(root+'/'+data);
        	$('#'+name+'_div').css('background-image', 'url('+root+'/'+data+')');
        	$('#'+name+'_div').css('background-size', 'contain');
        	$('#'+name+'_div').css('background-repeat','no-repeat');
        	$('#'+name+'_div').css('width', '200px');
        	$('#'+name+'_div').css('height','200px');
        	$('#image_url_link').attr('href',root+'/'+data);
        	if ($ ("#image_height") ){
				var img = new Image();
				var img_url =root+'/'+data;
				img.src = img_url;//高さと幅を取得したいURLを入力
				img.onload = function(){
					$('#image_height').val(img.naturalHeight+'/'+img.naturalWidth);
//					alert($('#image_height').val());
				};

        	}
        },

        //失敗の場合、以下を行う。
        error :  function(XMLHttpRequest, textStatus, errorThrown) {

            alert('通信ができない状態です。');
        }
    });
}
function setHidden(name,value){
	$('#'+name).val(value);
//	alert($('#'+name).val());
}

function selectImg(name,root,file){
	name=$('#targetObj').val()

	            $('#'+name).val(file);
	        	$('#'+name+'_div').css('background-image', 'url('+file+')');
	        	$('#'+name+'_div').css('background-size', 'contain');
	        	$('#'+name+'_div').css('background-repeat','no-repeat');
	        	$('#'+name+'_div').css('width', '200px');
	        	$('#'+name+'_div').css('height','200px');
	        	$('#image_url_link').attr('href',file);
	        	if ($ ("#image_height") ){
					var img = new Image();
					var img_url =file;
					img.src = img_url;//高さと幅を取得したいURLを入力
					img.onload = function(){
						$('#image_height').val(img.naturalHeight+'/'+img.naturalWidth);
//						alert($('#image_height').val());
					};

	        	}
	}
function urlOnChecked(name1,name2,isChecked){
	if (isChecked){
		$('#'+name1).css('display','');
		$('#'+name2).css('display','none');
	}else{
		$('#'+name1).css('display','none');
		$('#'+name2).css('display','');
	}

    $('input[name=main_chk]').prop('checked', isChecked); //Set checkbox values
}

function getGps(actionurl){

	//ajaxでのcsrfトークン送信
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


    var city = $('#city').val();
    var perf_name = $('#pref_id option:selected').text();
//    if ($('#pref_id').val()!=null&&$('#pref_id').val().length>0){
//    	address = perf_name + address;
//    }
    //フォームデータを作成する。(送信するデータ)
    var form = new FormData();
    //フォームデータにテキストの内容、アップロードファイルの内容を格納する。
    form.append( 'city', city );
    form.append( 'perf_name', perf_name );
    form.append( 'pref_id', $('#pref_id').val() );
//    form.append( pref_id+"_file", fileData );

//    var actionurl="https://www.yahoo.co.jp";
    //    alert("https://maps.googleapis.com/maps/api/geocode/json?address=" + address + "CA&key=" +gpsKey);
//    location.href="https://maps.googleapis.com/maps/api/geocode/json?address=" + address + "CA&key=" +gpsKey;
    //ポスト送信する。
    $.ajax({
        type: 'post',
        url: actionurl,
        data: form,
        processData : false,
        contentType : false,
		//成功の場合、以下を行う。
		success: function(data){
			var str=new String(data);
//			alert(str);
			obj=str.split('/');
            $('#lat').val(obj[0]);
            $('#lng').val(obj[1]);
		},

		//失敗の場合、以下を行う。
		error :  function(XMLHttpRequest, textStatus, errorThrown) {

		    alert('通信ができない状態です。');
		    }
		});
}

function sendMany(name, actionurl, root) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var files = $('#' + name + '_file').prop('files');
    var fileCount = $('#' + name + '_file')[0].files.length;
    var uploadedImage = $('#image_counter').val();
  
    //checks if input is more than 100
    if (fileCount > 100) {
        alert('アップロード可能な画像数：100');

        return;
    }
  
    //checks if input and uploaded is more than 100
    if (uploadedImage != 0 && fileCount != 0) {
      var totalCount = parseInt(uploadedImage) + parseInt(fileCount);
      if (totalCount > 100) {
        alert('アップロード可能な画像数：100');
  
        return;
      }
    }
  
    $.map(files, function(value, key) {
      var extension = $('#' + name + '_file').val().split('.').pop().toLowerCase();
      if (actionurl.indexOf('banner') > 0) {
        if ($.inArray(extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'pdf']) == -1) {
          alert('有効な写真を選択してください... ');

          return;
        } 
      } else {
        if ($.inArray(extension, ['jpg', 'jpeg','png', 'gif','bmp']) == -1) {
          alert('有効な写真を選択してください... ');

          return;
        }
      }
  
      //テキストの入力値を取得する。Get the text input value.
      var textData = $('#' + name).val(); //textbox
  
      //アップロードファイルの入力値を取得する。
      var fileData = value;
  
      //フォームデータを作成する。(送信するデータ) 
      var form = new FormData();
  
      //フォームデータにテキストの内容、アップロードファイルの内容を格納する。
      form.append('targetName', name);
      form.append(name, textData);
      form.append(name + '_file', fileData);
      //ポスト送信する。
      $.ajax({
        type: 'post',
        url: actionurl,
        data: form,
        processData : false,
        contentType : false,
        success: function(data) {
          var div = document.getElementById('image_url_div');
          var img = document.createElement('img');
          var input = document.createElement('input');
          var inputWidth = document.createElement('input');
          var inputHeight = document.createElement('input');

          // for image rendering
          img.src = root + '/' + data;
          img.style.height = '200px';
          img.style.width = '200px';
          img.style.margin = '10px 10px 10px 10px';
          img.className = 'reader_image_success';

          input.type = 'hidden';
          inputWidth.type = 'hidden';
          inputHeight.type = 'hidden';

          div.appendChild(inputWidth);
          div.appendChild(inputHeight);

          var img_url = root + '/' + data;
          input.value = img_url;
          
          if ($('#image_counter').val() != 0) {
            var newKey = parseInt($('#image_counter').val()) + 1;
            $('#image_counter').val(newKey);

            input.name = 'image_url_' + newKey;
            img.id = 'reader_image_' + newKey;

            inputWidth.name = 'image_width_' + newKey;
            inputHeight.name = 'image_height_' + newKey;
            
          } else {
            input.name = 'image_url_1';
            $('#image_counter').val(1);
            img.id = 'reader_image_1';

            inputWidth.name = 'image_width_1';
            inputHeight.name = 'image_height_1';
          }

          div.appendChild(input);
          div.appendChild(img);

          $('output').empty(); //set the output element to empty
          $('#' + name + '_file').val('') //set the input file to empty

          img.onload = function() {
            inputWidth.value = img.naturalWidth;
            inputHeight.value = img.naturalHeight;
          };
        },
        error: function(data) {
          alert('通信ができない状態です。');
        }
      });
    });

    return true;
}
