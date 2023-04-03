<script lang="ts">
	import { ConicGradient, dataTableHandler } from '@skeletonlabs/skeleton';
	import type { ConicStop } from '@skeletonlabs/skeleton';
	import { answers } from '../../../stores.js';
    import { onMount } from 'svelte';

	const endpoint = "http://localhost/QuizWiz/backend/score.php";

	let answerAAA;
	answers.subscribe(value => {
		answerAAA = value;
	})
	let conicStops: ConicStop[];

	onMount(async () => {
		const res = await fetch(endpoint, {
			method: 'POST',
			headers: {
				'Accept': 'application/json',
			},
			body: JSON.stringify({
				answerAAA
			})
		});

		const data = await res.json();

		let amount = 0;
		data.forEach(value => {
    		amount += value;
  		});

		conicStops = [
			{ color: 'rgba(102, 255, 102,1)', start: 0, end: (data[0]/amount)*100 },
			{ color: 'rgba(255, 80, 80, 1)', start: (data[0]/amount)*100, end: ((data[0]/amount)*100 + (data[1]/amount)*100) },
			{ color: 'rgba(179, 179, 179, 1)', start: ((data[0]/amount)*100 + (data[1]/amount)*100), end: ((data[0]/amount)*100 + (data[1]/amount)*100 + (data[2]/amount)*100) }
		];

		answers.set({});
	})
</script>

<main>
	<h1>QUIZ SCORE</h1>

	<div id="container">
		<div id="chart">
			<ConicGradient stops={conicStops}></ConicGradient>
		</div>
		<div id="text">
			<p>11111</p>
			<p>22222</p>
			<p>33333</p>
		</div>
	</div>
	<div id="info">
		<p>ABCDEF</p>
	</div>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
	}

	#container {
		display: flex;
		flex-direction: row;
		gap: 20px;
		justify-content: center;
  		align-items: center;
		margin: 30px;
	}

	#text {
		text-align: center;
	}
</style>
