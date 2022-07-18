<!doctype html>
<head>
<script src="https://sdk.amazonaws.com/js/aws-sdk-2.1174.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">

//Bucket Configurations

     	var bucketNameConfig = 'rnd-web';
	var bucketRegionConfig = 'ap-south-1';
	var IdentityPoolIdConfig = 'ap-south-1:2dd97b1d-8ca7-4fb9-a0ef-51ba9eba2538';

	AWS.config.update({
		credentials: new AWS.CognitoIdentityCredentials({
		    IdentityPoolId: IdentityPoolIdConfig
		}),
		region: bucketRegionConfig
	});
	
	var bucket = new AWS.S3({
	    apiVersion: '2015-12-08',
	    params: {Bucket: bucketNameConfig}
	});
</script>
</head>
<body>
    <!-- A functional html code-->
    <h2>PHP Upload File</h2>
        <label for="file_name">Filename:</label>
    <div>
        <input type="file" id="fileUpload">
    </div>

    <div>
    <button onclick="s3upload()">Submit</button>
    </div>

    <progress max="100" value="0"></progress>
    
    	<div id="container">
		

		<div class="description">
			A JavaScript library to zip and unzip files
			<hr>
		</div>

		<h2>Read a zip file (demo)</h2>

		<ol id="demo-container">
			<li>
				<label>
					<span class="form-label">choose a zip file</span>
					<button id="file-input-button">Open...</button>
					<input type="file" id="file-input" accept="application/zip" hidden>
				</label>
			</li>
			<li id="encoding-item">
				<label>
					<span class="form-label">select the encoding of names</span>
					<select id="encoding-input" disabled>
						<option>utf-8</option>
						<option>cp437</option>
						<option>ibm866</option>
						<option>iso-8859-2</option>
						<option>iso-8859-3</option>
						<option>iso-8859-4</option>
						<option>iso-8859-5</option>
						<option>iso-8859-6</option>
						<option>iso-8859-7</option>
						<option>iso-8859-8</option>
						<option>iso-8859-10</option>
						<option>iso-8859-13</option>
						<option>iso-8859-14</option>
						<option>iso-8859-15</option>
						<option>iso-8859-16</option>
						<option>koi8-r</option>
						<option>koi8-u</option>
						<option>macintosh</option>
						<option>windows-874</option>
						<option>windows-1250</option>
						<option>windows-1251</option>
						<option>windows-1252</option>
						<option>windows-1253</option>
						<option>windows-1254</option>
						<option>windows-1255</option>
						<option>windows-1256</option>
						<option>windows-1257</option>
						<option>windows-1258</option>
						<option>x-mac-cyrillic</option>
						<option>gbk</option>
						<option>gb18030</option>
						<option>big5</option>
						<option>euc-jp</option>
						<option>iso-2022-jp</option>
						<option>shift-jis</option>
						<option>euc-kr</option>
						<option>utf-16be</option>
						<option>utf-16le</option>
						<option>x-user-defined</option>
					</select>
				</label>
			</li>
			<li>
				<label>
					<span class="form-label">set the password</span>
					<input type="password" id="password-input" value="" disabled>
				</label>
			</li>
			<li>
				<label>
					<span class="form-label">download uncompressed files</span>
					<ul id="file-list" class="empty">
					</ul>
				</label>
			</li>
		</ol>

	</div>
	<script type="text/javascript" src="/js/zip.min.js"></script>
	<script type="text/javascript" src="/js/unzip.js"></script>

    <script type="text/javascript">

      function s3upload() {  
                var files = document.getElementById('fileUpload').files;
                if (files) 
                {
                    var file = files[0];console.log(file);
                    var fileName = file.name;
                    var filePath = 'vrstorage/' + fileName;
                    var fileUrl = 'https://' + 'ap-south-1' + '.amazonaws.com/rnd/' +  filePath;
            
                    bucket.upload({
                                    Key: filePath,
                                    Body: file,
                                    ACL: 'public-read'
                                }, function(err, data) {
                                    if(err) {
                                        reject('error');
                                    }
                                    
                                    alert('Successfully Uploaded!');
                                }).on('httpUploadProgress', function (progress) {
                                    var uploaded = parseInt((progress.loaded * 100) / progress.total);
                                    $("progress").attr('value', uploaded);
                                });
                }
      };
      
      function s3uploadzip1(entries) {  
      		entries.forEach((entry, entryIndex) => {
		        //var files = entry;//document.getElementById('fileUpload').files;
		        //if (entry) 
		        //{
		            var blobUrl = getBlobUrl(entry);
		            var file = entry; console.log(blobUrl);
		            var fileName = file.filename;
		            var filePath = 'vrstorage/' + fileName;
		            var fileUrl = 'https://' + 'ap-south-1' + '.amazonaws.com/rnd/' +  filePath;
		    
		            bucket.upload({
		                            Key: filePath,
		                            Body: data,
		                            ACL: 'public-read'
		                        }, function(err, data) {
		                            if(err) {
		                                reject('error');
		                            }
		                            
		                            alert('Successfully Uploaded!');
		                        }).on('httpUploadProgress', function (progress) {
		                            var uploaded = parseInt((progress.loaded * 100) / progress.total);
		                            $("progress").attr('value', uploaded);
		                        });
		        //}
                });
      };
    </script>
</body>
</html>

