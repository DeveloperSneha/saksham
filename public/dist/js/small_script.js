var   w = 800,
      h = 500;

var circleWidth = 40;

var palette = {
      "lightgray": "#819090",
      "gray": "#708284",
      "mediumgray": "#536870",
      "darkgray": "#475B62",
      "black": "#394035",
      "greensustain": "#ff8000",
      "darkblue": "#0A2933",
      "darkerblue": "#042029",
      "paleryellow": "#FCF4DC",
      "paleyellow": "#EAE3CB",
      "yellow": "#A57706",
      "orange": "#BD3613",
      "red": "#D11C24",
      "pink": "#C61C6F",
      "purple": "#595AB7",
      "blue": "#2176C7",
      "green": "#259286",
      "yellowgreen": "#738A05"}

var nodes = [
      { name: "Saksham",target: [0], img: "/assets/images/nodes/saksham.png",click:"View",link: "/about"},
      { name: "Agriculture",target: [0], img: "/assets/images/nodes/agriculture.png",click:"View",link: "/agriculture/"},
      { name: "Electronics ", target: [0], img: "/assets/images/nodes/electronics.png",click:"View",link: "/electronics/"},
      { name: "Telecom", target: [0], img: "/assets/images/nodes/telecom.png",click:"View",link: "/telecom/"},
      { name: "Apparel", target: [0], img: "/assets/images/nodes/apparel.png",click:"View",link: "/apparel/"},
      { name: "Entrepreneurship", target: [0], img: "/assets/images/nodes/enterpreneur.png",click:"View",link: "/apparel/"},
      { name: "Banking Financial Services And Insurance Services", target: [0], img: "/assets/images/nodes/banking.png",click:"View",link: "/apparel/"},
      ];

var links = [];
var saksham_courses_hub_and_spoke=[];
//We will get this data from index file
var nodes = saksham_courses_hub_and_spoke;

for (var i = 0; i< nodes.length; i++) {
      if (nodes[i].target !== undefined) {
            for (var x = 0; x< nodes[i].target.length; x++ ) {
                  links.push({
                        source: nodes[i],
                        target: nodes[nodes[i].target[x]]
                  })
            }
      }
}
if (screen.width >= 600) {
	wdf = 900;
var myChart = d3.select('div#chart')
		.append('svg')
		.attr("viewBox", "10 0 " + w + " " + h )
        .attr("preserveAspectRatio", "xMidYMid meet")

        .attr("width", wdf)
        .attr("height", wdf * h / w)
}else{
	wdf = window.innerWidth;
var myChart = d3.select('div#chart')
		.append('svg')
		.attr("viewBox", "40 0 " + w + " " + h )
        .attr("preserveAspectRatio", "xMidYMid meet")

        .attr("width", wdf)
        .attr("height", wdf * h / w)
}


var force = d3.layout.force()
	.nodes(nodes)
	.links([])
	.gravity(0.2)
	.charge(-2000)
	.size([w, h])
	.linkDistance(60)
    .friction(0.925)
    .linkStrength(function(l, i) {return 8; })
    

var link = myChart.selectAll('line')
	.data(links).enter().append('line')
	.attr('stroke', palette.gray);

var node = myChart.selectAll('circle')
	.data(nodes).enter()
	.append('g')
	.call(force.drag);

 node.append("svg:a")
    .attr("xlink:href", function(d){return d.link})
	.append('circle')
	.attr('cx', function(d) { return d.x; })
	.attr('cy', function(d) { return d.y; })
	.attr('r',function(d, i) {
		if (i>0) { return circleWidth  }
		else { return circleWidth + 12 }
	})
	.attr('fill', function(d, i) {
		if (i>0) { return palette.greensustain }
		else { return palette.black }
	})

	click = node.append('text')
	.text(function(d) { return d.click})
	.attr('font-family', 'Play')
	.attr('x', -15)
	.attr('y', 5)
	.attr('font-size', 15)
	.attr('fill',
	  function(d, i) {
		if (i>0) { return palette.black }
		else { return  palette.greensustain}
	})


// Append images
  var images = node.append("svg:a")
   .attr("xlink:href", function(d){return d.link;}).append("svg:image")
        .attr("xlink:href",  function(d) { return d.img;})
        .attr("x", function(d,i) { if (i>0) { return -40  }
		else { return -50 }})
        .attr("y", function(d,i) { if (i>0) { return -41  }
		else { return -50 }})
        
        .attr("height", function(d, i) {
		if (i>0) { return 80  }
		else { return 100 }
	})
        .attr("width", function(d, i) {
		if (i>0) { return 80  }
		else { return 100}
	});


// make the image grow a little on mouse over
  var setEvents = images.on( 'mouseenter', function() {
            // select element in current context
            d3.select(this)
              .transition()
              .duration(600) 
              .style('opacity', 0);
          })
          // set back
          .on( 'mouseleave', function() {
            d3.select( this )
              .transition()
              .duration(500)
               .delay(500)
                 .style('opacity', 1);  
          });
          

node.append('text')
	.text(function(d) { return d.name})
	.attr('font-family', 'Play')
	.attr('fill', function(d, i) {
		if (i>0) { return palette.mediumgray}
		else { return palette.greensustain}
	})
	.attr('x', circleWidth - 70)
	.attr('y', circleWidth + 20)
	.attr('text-anchor', 'beginning')
	.attr('font-size',  function(d, i) {
		if (i>0) { return '1em' }
		else { return '1.25em'}
	})


force.on('tick', function(e) {
	node.attr('transform', function(d, i) {
		return 'translate('+ d.x +', '+ d.y +')';
	})

	link
		.attr('x1', function(d) { return d.source.x })
		.attr('y1', function(d) { return d.source.y })
		.attr('x2', function(d) { return d.target.x })
		.attr('y2', function(d) { return d.target.y })
})


force.start();

window.addEventListener('resize', resize); 

function resize() {
	var wd = window.innerWidth;
	if(wd<800){
        myChart.attr("width", wd);
        myChart.attr("height", wd * h / w);
    }else{
    	var wdef = 800;
    	myChart.attr("width", wdef);
        myChart.attr("height", wdef * h / w);
    }
        force.size([w, h]).resume();
}