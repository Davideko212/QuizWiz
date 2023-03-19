<script>
    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";
	
</script>

<main>
	<img src="assets/logo/QuizWiz.png">

    <div id="category">
        <CategorySelect />
    </div>

    <div id="question">
        <QuestionSelect />
    </div>

    <div id="startbutton">
        <button type="button">
            Quiz starten
        </button>
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

    #startbutton {
        width: 10%;
    }
</style>