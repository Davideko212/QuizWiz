<script lang="ts">
    import { Step } from '@skeletonlabs/skeleton';
    import StarRating from 'svelte-star-rating';
    import { answers } from '../stores';

    export let question: Object;

    function onChange(PK_FrageId: number, FK_AntwortID: number) {
		$answers[PK_FrageId] = FK_AntwortID;
	}

	function getType(q) {
		let type = q.Antworttyp;

		switch (type) {
			case 0:
				return "radio";
			case 1:
				return "checkbox";
		}
	}

    const config = {
        emptyColor: "hsl(240, 80%, 85%)",
		fullColor: "#ff5900",
		size: 20
    };
</script>

<style>
    #stretcher {
		padding-bottom: 20vh;
	}

	#answer {
		display: flex;
		flex-direction: row;
		gap: 12px;
		font-size: large;
	}

	#container {
		display: flex;
		flex-direction: row;
	}

	#answers {
		display: flex;
		flex-direction: column;
		gap: 15px;
	}

	#info {
		margin-left: auto;
		text-align: end;
	}
</style>

<Step>
    <svelte:fragment slot="header">{question.Fragestellung}</svelte:fragment>
    <div id="container">
        <div id="answers">
            {#each question[0] as answer}
                <div id="answer">
                    <!-- i mean it works -->
                    <input
                        type={getType(question)}
                        name={question.PK_FrageId} checked={$answers[question.PK_FrageId] === answer.FK_AntwortID} value={answer.FK_AntwortID} id={answer.FK_AntwortID} 
                        on:change={onChange(question.PK_FrageId, answer.FK_AntwortID)}
                    >
                    <label for={answer.FK_AntwortID}>{answer.Antwortmoeglichkeit}</label>
                </div>
            {/each}
        </div>
        <div id="info">
            <i>{question.KategorienName}</i>
            <StarRating rating={question.Schwierigkeit/2} {config}/>
        </div>
    </div>
</Step>