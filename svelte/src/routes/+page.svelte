<script lang="ts">

    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";

</script>

<main>
	<img src="/QuizWiz.png">
	<CategorySelect />
	<QuestionSelect />
	<button type="button" class="btn variant-filled">
		Quiz Starten
	</button>
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
