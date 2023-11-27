<?php
	require 'database.php';
	
	session_start();
	
	$user = $_SESSION['login'];
    $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * from users where username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $info_user = $q->fetch(PDO::FETCH_ASSOC);
		
		$sql = "SELECT * from recycling_stalk where user_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($info_user['user_id']));
        $data = $q->fetch(PDO::FETCH_ASSOC);
		
        Database::disconnect();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mon profil</title>
	<meta charset="utf-8">
	<link   href="../assets/css/account.css" rel="stylesheet">
	<script src="https://d3js.org/d3.v4.js"></script>
  </head>
  
  <body>
	<h1> Mon profil </h1>
		<section id="profile">
			<h2> Mes informations </h2>
			<p> Prénom : <?php echo $info_user['firstname'];?> </p>
			<p> Nom : <?php echo $info_user['name'];?> </p>
			<p> Date de naissance : <?php echo date('d/m/Y',strtotime($info_user['birth_date']));?> </p>
			<p> Situation : <?php echo $info_user['job'];?> </p>
			<p> Code postal : <?php echo $info_user['zip_code'];?> </p>
			</br> </br>
			<button style='cursor:pointer'> Scanner un déchet </button>
		</section>
		<section id="settings">
			<h2> Mes déchets triés </h2>
			<div id="my_dataviz"></div>
			<script>
				var totalGM= <?php echo $data['nb_g_m'];?> ;
				var totalOrga= <?php echo $data['nb_organic'];?>;
				var totalother= <?php echo $data['nb_other'];?>;
				var totalpaper= <?php echo $data['nb_paper'];?>;
				var totalplastique= <?php echo $data['nb_plastic'];?>;

				// create a data_set
				var data1 = [
					{group: "Métal & Verre", value: totalGM },
					{group: "Organique", value: totalOrga},
					{group: "Autres", value: totalother},
					{group: "Papiers & Cartons", value: totalpaper},
					{group: "Plastique", value: totalplastique}
				];

				// set the dimensions and margins of the graph
				var margin = {top: 30, right: 30, bottom: 70, left: 60},
					width = 460 - margin.left - margin.right,
					height = 400 - margin.top - margin.bottom;
  
				// append the svg object to the body of the page
				var svg = d3.select("#my_dataviz")
					.append("svg")
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
  
				// X axis
				var x = d3.scaleBand()
					.range([ 0, width ])
					.domain(data1.map(function(d) { return d.group; }))
					.padding(0.2);
				svg.append("g")
				.attr("transform", "translate(0," + height + ")")
				.call(d3.axisBottom(x))
  
				// Add Y axis
				var y = d3.scaleLinear()
					.domain([0, 100])
					.range([ height, 0]);
				svg.append("g")
					.attr("class", "myYaxis")
					.call(d3.axisLeft(y));
  
				// A function that create / update the plot for a given variable:
				function update(data) {
  
					var u = svg.selectAll("rect")
						.data(data)
  
					u.enter()
						.append("rect")
						.merge(u)
						.transition()
						.duration(1000)
						.attr("x", function(d) { return x(d.group); })
						.attr("y", function(d) { return y(d.value); })
						.attr("width", x.bandwidth())
						.attr("height", function(d) { return height - y(d.value); })
						.attr("fill", "#69b3a2")
				}
  
				// Initialize the plot with the first dataset
				update(data1)
			</script>
		</section>
	</body>
</html>