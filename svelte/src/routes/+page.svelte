<script lang="ts">

    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";

	import { popup } from '@skeletonlabs/skeleton';
	import type { PopupSettings } from '@skeletonlabs/skeleton';

	import { questions } from '../stores.js';

	const endpoint = "http://localhost/QuizWiz/backend/questions.php";
	//let questions = [];
	let categoriesSelected = {};
	$: categoriesSelectReact = categoriesSelected;

	let examplePopup: PopupSettings = {
		// Set the event as: click | hover | hover-click
		event: 'click',
		// Provide a matching 'data-popup' value.
		target: 'examplePopup',
		placement: 'bottom'
	};

	async function fetchQuestions() {
		const res = await fetch(endpoint, {
			method: 'GET',
			body: JSON.stringify({
				
			})
		});

		const data = await res.json();
		
		Object.keys(data).forEach(function (key){
			questions.push(data[key]);
		});

        questions = questions;
	}
</script>

<main>
	<img src="/QuizWiz.png">
	<CategorySelect bind:categoriesSelected={categoriesSelected}/>
	<QuestionSelect />
	<a class="btn variant-filled" href="/quiz" on:click={fetchQuestions}>
		Quiz starten
	</a>
	<button class="btn variant-filled" use:popup={examplePopup}>Trigger</button>
	<div class="card p-4 w-72 shadow-xl" data-popup="examplePopup">
		<div class="space-y-4">
			<div>
				<p class="font-bold">Skeleton</p>
				<p class="opacity-50">@SkeletonUI</p>
			</div>
			<p>Skeleton is a fully featured UI component library using the power of Svelte + Tailwind.</p>
			<div class="flex gap-4">
				<small><strong>50</strong> <span class="opacity-50">Following</span></small>
				<small><strong>440</strong> <span class="opacity-50">Followers</span></small>
			</div>
			<a class="btn variant-soft w-full" href="https://twitter.com/SkeletonUI" target="_blank" rel="noreferrer">
				View on Twitter
			</a>
		</div>
		<!-- Arrow -->
		<div class="arrow bg-surface-100-800-token" />
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

	img {
		width: 40%;
	}
</style>
