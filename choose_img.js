const image_input = document.querySelector("#newproduct_image");
var uploaded_image = "";

image_input.add("change", function(){
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        uploaded_image = reader.result;
        document.querySelector("#display_image").getElementsByClassName.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.file[0]);
})
