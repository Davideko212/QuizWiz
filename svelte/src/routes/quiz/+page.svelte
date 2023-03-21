<script lang="ts">
	import { onMount } from 'svelte';
	import { Stepper, Step } from '@skeletonlabs/skeleton';

	const endpoint = "http://localhost/QuizWiz/backend/questions.php";
	let questions = [];

	onMount(async () => {
		const res = await fetch(endpoint, {
			method: 'GET'
		});

		const data = await res.json();
		
		Object.keys(data).forEach(function (key){
			questions.push(data[key]);
		});

        questions = questions;
	});
</script>

<main>
	<h1>QUIZ</h1>

	<div id="stepper">
		<Stepper>
			{#each questions as q}
				<Step>
					<svelte:fragment slot="header">{q.Fragestellung}</svelte:fragment>
					AAAAAAAAAAAAAAAAAAAAA
				</Step>
			{/each}
		</Stepper>
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

	#stepper {
		min-width: 60%;
	}
</style>
