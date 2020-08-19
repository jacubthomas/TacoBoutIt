// menu dropdowns by image clicks
let images = document.querySelectorAll(".item_img");
for( let i=0; i<images.length; i++ )
{
    images[i].onclick = function()
    {
        images[i].nextElementSibling.classList.toggle("show");
    }
}

// nav bar toggle button functionality
let tog = document.querySelector(".navbar-toggler")
tog.onclick = function()
{
    document.querySelector("#drop_nav").classList.toggle("show");
}

// error handling to prevent users from entering negative values
let quantity = document.querySelectorAll(".quant");
for( let i=0; i<quantity.length; i++ )
{
    quantity[i].onchange = function()
    {
        if(quantity[i].value < 0)
        {
            quantity[i].value = 0;
        }
    }
}
