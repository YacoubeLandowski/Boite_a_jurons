
var datalist= new Array(40, 80, 70, 20 ); 
var colist = new Array('blue', 'red', 'green', 'orange');
var canvas = document.getElementById("myCanvas"); 
var ctx = canvas.getContext('2d');
pie(ctx, canvas.width, canvas.height, datalist);

function pie(ctx, w, h, datalist)
{
  var radius = h / 2 - 2;
  var centerx = w / 3;
  var centery = h / 2;
  var total = 0;
  for(x=0; x < datalist.length; x++) { total += datalist[x]; }; 
  var lastend=0;
  var offset = Math.PI / 2;
  for(x=0; x < datalist.length; x++)
  {
    var thispart = datalist[x]; 
    ctx.beginPath();
    ctx.fillStyle = colist[x];
    ctx.moveTo(centerx,centery);
    var arcsector = Math.PI * (2 * thispart / total);
    ctx.arc(centerx, centery, radius, lastend - offset, lastend + arcsector - offset, false);
    ctx.lineTo(centerx, centery);
    ctx.fill();
    ctx.closePath();		
    lastend += arcsector;	
  }
}

