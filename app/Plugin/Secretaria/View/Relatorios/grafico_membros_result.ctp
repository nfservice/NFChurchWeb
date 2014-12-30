<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Gráfico de Membros - Resultado
		</header>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12">
					<section class="panel">
						<div class="panel-body">
							<div id="visitors-chart">
								<div id="visitors-container" style="width: 100%;height:300px; text-align: center; margin:0 auto;">
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready(function(){
		var data7_1 = {"total":[			
			<?php 
				foreach ($membros as $key => $value) {
					echo '['.$value['Membro']['ano'].', '.$value['Membro']['mes'].', '.$value['Membro']['soma'].'],';
				}
			?>
		]};

		seriesData = [];    
		for (var prop in data7_1) {
			// push in the series, the "property" is the label
			// use $.map to produce an array of [date, y-value]
			// the new Date(i[0],i[1]-1).getTime(), 
			// will give you the epoch time for the first day of that month/year
			seriesData.push({label: prop, data:$.map(data7_1[prop], function(i,j){
				 return [[new Date(i[0],i[1]-1).getTime(), i[2]]];
			})});    
		}

		$.plot("#visitors-chart #visitors-container", seriesData, {
		    xaxis: { 
		    	mode: "time", 
		    	timeformat: "%b %Y",
		    	monthNames: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
		    },
		    grid: {
				hoverable: true,
				clickable: true,
				tickColor: "#f9f9f9",
				borderWidth: 1,
				borderColor: "#eeeeee"
			},
			tooltip: true,
			tooltipOpts: {
				defaultTheme: false
			},
			lines: {
				fill: true
			},
			series: {
					lines: {
						show: true,
						fill: false
					},
					points: {
						show: true,
						lineWidth: 2,
						fill: true,
						fillColor: "#ffffff",
						symbol: "circle",
						radius: 5
					},
					shadowSize: 0
				}
		});
	});
</script>