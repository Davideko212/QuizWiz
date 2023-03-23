<script lang="ts">
	import { onMount } from 'svelte';
	import { Stepper, Step } from '@skeletonlabs/skeleton';
	import { questions } from '../../stores.js';

	let questionsValue;
	questions.subscribe(value => {
		questionsValue = value;
	});

	let answers = {};
	questionsValue.forEach(question => answers[question.PK_FrageId] = -1);

	function isSelected(PK_FrageId, FK_AntwortID) {
		if (answers[PK_FrageId] == FK_AntwortID)
		// TODO: save selected answers in array
	}
</script>

<main>
	<h1>QUIZ</h1>

	<div id="stepper">
		<Stepper>
			{#each questionsValue as q}
				<Step>
					<svelte:fragment slot="header">{q.Fragestellung}</svelte:fragment>
					{#each q[0] as answer}
						<div id="answer">
							<input type="radio" name={q[0]} id={answer.FK_AntwortID}><label for={answer.FK_AntwortID}>{answer.Antwortmoeglichkeit}</label>
						</div>
					{/each}
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

	#answer {
		display: flex;
		flex-direction: row;
		gap: 10px;
	}
</style>
