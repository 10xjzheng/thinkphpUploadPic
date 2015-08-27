# thinkphpUploadPic
thinkphp+单图片上传+多图片上传

##单图片上传：使用修改后的uploadify插件

使用方法：  

1.添加/Public/plugins/uploadify文件夹；

2.html：见onePic.html,主要是引入js和css文件，在js使用 $("#picUpload").uploadify({})配置，注意修改控件的id；

3.php：处理上传图片返回json，见BaseAction中的uploadPic方法；

###效果图

![res1](/img/res1.png)


##多图片上传：使用修改后的plulodad插件

使用方法

1.添加/Public/plugins/plulodad文件夹；

2.html：见multiPics.html,主要是引入js和css文件，在js使用uploader = new plupload.Uploader({})进行配置，注意修改控件的id；

3.php：处理上传图片返回json，见BaseAction中的multiUploadPic方法；

###效果图

![res2](/img/res2.png)