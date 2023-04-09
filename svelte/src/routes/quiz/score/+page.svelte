<script lang="ts">
	import { ConicGradient } from '@skeletonlabs/skeleton';
	import type { ConicStop } from '@skeletonlabs/skeleton';
	import { answers, questions } from '../../../stores';
    import { onMount } from 'svelte';

	const endpoint = "http://localhost/QuizWiz/backend/score.php";

	let answersValue: Object;
	answers.subscribe(value => {
		answersValue = value;
	})
	let conicStops: ConicStop[];

	let data: Array<number> = [];
	let amount = 0;
	let averageDiff: number = 0;
	onMount(async () => {
		if (Object.keys(answersValue).length === 0) {
			return;
		}

		const res = await fetch(endpoint, {
			method: 'POST',
			headers: {
				'Accept': 'application/json',
			},
			body: JSON.stringify({
				answersValue
			})
		});

		data = await res.json();

		data.forEach(value => {
    		amount += value;
  		});

		conicStops = [
			{ color: 'rgba(102, 255, 102, 1)', start: 0, end: (data[0]/amount)*100 },
			{ color: 'rgba(255, 80, 80, 1)', start: (data[0]/amount)*100, end: ((data[0]/amount)*100 + (data[1]/amount)*100) },
			{ color: 'rgba(179, 179, 179, 1)', start: ((data[0]/amount)*100 + (data[1]/amount)*100), end: ((data[0]/amount)*100 + (data[1]/amount)*100 + (data[2]/amount)*100) }
		];

		$questions.forEach(value => {
			averageDiff += value["Schwierigkeit"];
		});
		averageDiff /= amount;

		answers.set({});
		questions.set([]);
	})
</script>

<main>
	<h1>QUIZ SCORE</h1>

	{#if amount == 0}
		<h2>Die Auswertung wurde bereits abgeschlossen.</h2>
	{:else}
		<div id="container">
			<div id="chart">
				<ConicGradient stops={conicStops}></ConicGradient>
			</div>
			<div id="text">
				<p>Ergebnisse des Quizzes mit {amount} Fragen:</p>
				<div id="entry">
					<div id="color" style="background-color: rgba(102, 255, 102, 1);"></div>
					<p>{data[0]} richtig ({((data[0]/amount)*100).toFixed(2)}%)</p>
				</div>
				<div id="entry">
					<div id="color" style="background-color: rgba(255, 80, 80, 1);"></div>
					<p>{data[1]} falsch ({((data[1]/amount)*100).toFixed(2)}%)</p>
				</div>
				<div id="entry">
					<div id="color" style="background-color: rgba(179, 179, 179, 1);"></div>
					<p>{data[2]} unbeantwortet ({((data[2]/amount)*100).toFixed(2)}%)</p>
				</div>
			</div>
		</div>
		<div id="info">
			<p>Durchschnittliche Schwierigkeit der Fragen: {(averageDiff).toFixed(2)} / 10</p>
		</div>
	{/if}

	<a class="btn variant-filled" href="./../">
		Zurück zum Hauptmenü
	</a>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
		gap: 10px;
	}

	#container {
		display: flex;
		flex-direction: row;
		gap: 20px;
		justify-content: center;
  		align-items: center;
		margin: 20px;
	}

	#entry {
		display: flex;
		flex-direction: row;
		gap: 6px;
  		align-items: center;
		text-align: left;
	}

	#color {
		aspect-ratio: 1/1;
		width: 10px;
		height: 10px;
	}
</style>
