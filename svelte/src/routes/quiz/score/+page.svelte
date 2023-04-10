<script lang="ts">
	import { onMount } from 'svelte';
	import { answers, questions } from '../../../stores';
	import ScoreDisplay from '../../../components/ScoreDisplay.svelte';

	const endpoint = "http://localhost/QuizWiz/backend/score.php";

	let answersValue: Object;
	answers.subscribe(value => {
		answersValue = value;
	})

	let data: Array<number> = [];
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

		setTimeout(function() {
			answers.set({});
			questions.set([]);
		}, 100);
	})
</script>

<main>
	<h1>QUIZ AUSWERTUNG</h1>

	{#if data.length == 0}
		<h2>Die Auswertung wurde bereits abgeschlossen.</h2>
	{:else}
		<ScoreDisplay {data} />
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
</style>
