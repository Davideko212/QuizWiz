<script lang="ts">
    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";
	import { popup } from '@skeletonlabs/skeleton';
	import type { PopupSettings } from '@skeletonlabs/skeleton';
	import { toastStore } from '@skeletonlabs/skeleton';
	import type { ToastSettings } from '@skeletonlabs/skeleton';
	import { questions, lightmode } from '../stores.js';

	const endpoint = "http://localhost/QuizWiz/backend/questions.php";
	let categoriesSelected: Array<string> = [];
	$: console.log(categoriesSelected);
	let amount = 5;
	let diff = 5;
	let questionsValue;
	let target = "/";

	let examplePopup: PopupSettings = {
		// Set the event as: click | hover | hover-click
		event: 'click',
		// Provide a matching 'data-popup' value.
		target: 'examplePopup',
		placement: 'bottom'
	};

	const toast: ToastSettings = {
		// maybe change this text later
		message: '⚠️ Wählen Sie eine Kategorie aus! ⚠️',
	};

	async function fetchQuestions() {
		questions.set([]);

		const res = await fetch(endpoint, {
			method: 'POST',
			body: JSON.stringify({
				categoriesSelected,
				amount,
				diff
			})
		});

		const data = await res.json();
		
		Object.keys(data).forEach(function (key){
			//questions.push(data[key]);
			questions.update(items => {
				items.push(data[key]);
				return items;
			})
		});

		if (questionsValue.length === 0) {
			// If the quiz criteria result in finding no questions, show an error message
			toastStore.trigger(toast);
		} else {
			// Send the user to the quiz page
			target = "/quiz";
		}
	}

	questions.subscribe(value => {
		questionsValue = value;
	});

	let lightmodeValue: boolean;
	lightmode.subscribe(value => {
		lightmodeValue = value;
	});
</script>

<main>
	{#if lightmodeValue}
		<img src="/QuizWiz.png">
	{:else}
		<img src="/QuizWiz_dark.png">
	{/if}
	<CategorySelect bind:categoriesSelected={categoriesSelected}/>
	<QuestionSelect bind:amount={amount} bind:diff={diff}/>
	<a class="btn variant-filled" on:click={fetchQuestions} href={target}>
		Quiz starten
	</a>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
	}

	img {
		width: 40%;
	}
</style>
