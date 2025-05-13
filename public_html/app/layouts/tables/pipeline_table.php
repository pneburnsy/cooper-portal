<?php
function pipeline_table($pipeline_id) {

    // --------------------------- Information ---------------------------
    // Each proposal template must contain a 'prospect', 'completed' and 'lost' as certain actions attach the deal to these items by default.

    global $wpdb;
    global $pipeline_all;
    global $pipeline_data;

    $table_pipelines = $wpdb->prefix . 'pipelines';
    $table_columns   = $wpdb->prefix . 'pipeline_columns';
    $table_cards     = $wpdb->prefix . 'pipeline_cards';
    $table_proposals = $wpdb->prefix . 'pipeline_proposals';

    // Name
    $pipeline_id = isset($_GET['pipeline_id']) ? intval($_GET['pipeline_id']) : 1;
    $pipeline_name = $wpdb->get_var(
        $wpdb->prepare("
            SELECT name 
            FROM $table_pipelines 
            WHERE id = %d
        ", $pipeline_id)
    );

    // Columns
    $columns = $wpdb->get_results(
        $wpdb->prepare("
            SELECT * 
            FROM $table_columns 
            WHERE pipeline_id = %d 
            ORDER BY position ASC
        ", $pipeline_id)
    );

    // Get Unique Accounts
    accounts_team_distinct(false);
    global $accounts_team_distinct;

    ?>

    <!-- Header -->
    <div>
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-4">
            <a class="btn btn-primary" href="/app/page_pipeline.php?pipeline_id=1">Specialised</a>
            <a class="btn btn-primary" href="/app/page_pipeline.php?pipeline_id=2">Solution</a>
            <a class="btn btn-primary" href="/app/page_pipeline.php?pipeline_id=3">Rental</a>
        </div>
    </div>
    <div class="pipeline row align-items-center table-header-block section-block mb-2 flex">
        <div class="col-12 col-xl-3">
            <div>
                <h5 class="card-title"><?= $pipeline_name ?> Pipeline (<span id="total-count">0</span>)</h5>
            </div>
        </div>
        <div class="col-12 col-xl-9" style="text-align: right;">
            <div class="flex col-deals-parent">
                <span class="me-5 col-deals">
                    <strong class="me-1">All Deals:</strong>
                    <span id="grand-total"><?= form_currency($grand_total); ?></span>
                </span>
                <span class="me-5 col-deals">
                    <strong class="me-1">
                        <span class="type-circle-open"></span>
                        Open Deals (All):
                    </strong>
                    <span id="open-total">£0.00</span>
                </span>
                <span class="me-5 col-deals">
                    <strong class="me-1">
                        <span class="type-circle-open"></span>
                        Open Deals (90%+):
                    </strong>
                    <span id="open-total-90">£0.00</span>
                </span>
                <span class="me-5 col-deals">
                    <strong class="me-1">
                        <span class="type-circle-complete"></span>
                        Completed Deals:
                    </strong>
                    <span id="completed-deals">£0.00</span>
                </span>
                <span class="col-deals">
                    <strong class="me-1">
                        <span class="type-circle-lost"></span>
                        Lost Deals:
                    </strong>
                    <span id="lost-total">£0.00</span>
                </span>
            </div>
        </div>
    </div>

    <div class="row align-items-end table-header-block section-block mb-4">
        <div style="display: inline-block;">
            <div style="display: inline-block;">
                <button style="display: inline-block;" class="btn btn-primary btn-create me-2 mb-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#survey_add" aria-controls="offcanvasRight">Filters +</button>
                <button style="display: inline-block;" class="btn btn-danger btn-reset-filter mb-1" id="reset-filter" >Reset Filter</button>
            </div>
            <!-- New Deal Modal -->
            <div style="display: inline-block; float: right; width: fit-content;">
                <?php include 'layouts/includes/pipeline/modal/pipeline_team_create.php'; ?>
            </div>
        </div>
    </div>

    <?php include 'layouts/includes/pipeline/modal/pipeline_team_filters.php'; ?>

    <div class="row mt-6 mb-4 d-block">
        <div>
            <div class="d-flex gap-4" style="overflow:auto;">
                <?php
                function echo_overdue($date) {
                    if (empty($date)) {
                        return;
                    }
                    $today = new DateTime();
                    $targetDate = new DateTime($date);
                    if ($targetDate < $today) {
                        echo "overdue";
                    }
                }
                ?>
                <?php foreach ($columns as $column) : ?>

                    <?php

                    // -------------- Start - Card Query --------------

                    $created_from = isset($_GET['created_from']) ? $_GET['created_from'] : null;
                    $created_to = isset($_GET['created_to']) ? $_GET['created_to'] : null;
                    $close_date_filter = isset($_GET['close_date_filter']) ? sanitize_text_field($_GET['close_date_filter']) : "all";
                    $closed_from = isset($_GET['closed_from']) ? $_GET['closed_from'] : null;
                    $closed_to = isset($_GET['closed_to']) ? $_GET['closed_to'] : null;
                    $close_date = isset($_GET['close_date']) ? $_GET['close_date'] : null;
                    $priority = isset($_GET['priority']) ? $_GET['priority'] : 'all';
                    $probability = isset($_GET['probability']) ? $_GET['probability'] : 'all';
                    $region = isset($_GET['region']) ? $_GET['region'] : 'all';
                    $account = isset($_GET['account']) ? sanitize_text_field($_GET['account']) : null;
                    $make = isset($_GET['make']) ? sanitize_text_field($_GET['make']) : "all";
                    $creator = isset($_GET['creator']) ? sanitize_text_field($_GET['creator']) : "";
                    $assignee = isset($_GET['assignee']) ? sanitize_text_field($_GET['assignee']) : "";

                    $query = "
                        SELECT
                            c.id AS card_id,
                            c.column_id,
                            c.proposal_id,
                            c.creation_date AS card_creation_date,
                            c.updated_date AS card_updated_date,
                            p.*
                        FROM {$table_cards} c
                        LEFT JOIN {$table_proposals} p
                            ON c.proposal_id = p.id
                        WHERE c.column_id = %d
                    ";

                    $query_params = [$column->id];

                    if ($assignee !== "") {
                        $query .= " AND p.assignee = %d";
                        $query_params[] = (int)$assignee;
                    }

                    if ($creator !== "") {
                        $query .= " AND p.user_id = %d";
                        $query_params[] = (int)$creator;
                    }

                    if ($make !== "all") {
                        $query .= " AND p.make = %s";
                        $query_params[] = $make;
                    }

                    if ($created_from) {
                        $query .= " AND DATE(p.creation_date) >= DATE(%s)";
                        $query_params[] = $created_from;
                    }

                    if ($created_to) {
                        $query .= " AND DATE(p.creation_date) <= DATE(%s)";
                        $query_params[] = $created_to;
                    }

                    if (!empty($closed_from) && !empty($closed_to)) {
                        $query .= " AND DATE(p.close_date) BETWEEN DATE(%s) AND DATE (%s)";
                        $query_params[] = $closed_from;
                        $query_params[] = $closed_to;
                    } elseif (!empty($closed_from)) {
                        $query .= " AND DATE(p.close_date) >= DATE(%s)";
                        $query_params[] = $closed_from;
                    } elseif (!empty($closed_to)) {
                        $query .= " AND DATE(p.close_date) <= DATE(%s)";
                        $query_params[] = $closed_to;
                    }

                    if ($close_date_filter === "overdue") {
                        $query .= " AND p.close_date < CURDATE()";
                    } elseif ($close_date_filter === "not_due") {
                        $query .= " AND p.close_date >= CURDATE()";
                    } elseif ($close_date_filter === "not_set") {
                        $query .= " AND (p.close_date IS NULL OR p.close_date = '0000-00-00')";
                    }

                    if ($priority !== 'all') {
                        $query .= " AND p.priority = %d";
                        $query_params[] = (int)$priority;
                    }

                    if ($probability !== 'all') {
                        if ($probability === '0-50') {
                            $query .= " AND p.percentage <= 50";
                        } elseif ($probability === '50-90') {
                            $query .= " AND p.percentage >= 50 AND p.percentage <= 90";
                        } elseif ($probability === '90-100') {
                            $query .= " AND p.percentage >= 90";
                        }
                    }

                    if ($region !== 'all') {
                        $query .= " AND p.region = %s";
                        $query_params[] = $region;
                    }

                    if ($account) {
                        $query .= " AND p.clientaccount = %s";
                        $query_params[] = $account;
                    }

                    // $query .= " ORDER BY c.id ASC";
                    $query .= " ORDER BY 
                                CASE 
                                    WHEN p.close_date IS NULL THEN 2 
                                    WHEN p.close_date < CURDATE() THEN 0 
                                    ELSE 1 
                                END, p.close_date ASC, c.id ASC";

                    $cards = $wpdb->get_results($wpdb->prepare($query, ...$query_params));

                    // Count
                    $count_cards = count($cards);
                    // Total Quote
                    $total_quote_cards = 0;
                    foreach ($cards as $card) {
                        $total_quote_cards += $card->total_quote;
                    }

                    // -------------- End - Card Query --------------

                    ?>

                    <!-- Column -->
                    <div class="pipeline-container-parent">
                        <!-- Column Header -->
                        <div class="d-inline-block mt-2">
                            <div class="d-inline-block column-color" style="background-color:<?= $column->color; ?>;"></div>
                            <h6 class="d-inline-block">
                                <?php echo esc_html($column->name); ?>
                                (<span data-column class="to-be-added" id="count-<?= $column->id ?>"><?= $count_cards ?></span>)
                            </h6>
                            <p style="margin-left: 14px;">
                                <span id="total-<?= $column->id ?>">
                                    <?= form_currency($total_quote_cards) ?>
                                </span>
                            </p>
                        </div>
                        <!-- Column Body -->
                        <div id="column-<?= $column->id ?>" data-column-name="<?= $column->name ?>" data-column-id="<?= $column->id ?>" ondragover="event.preventDefault();" ondrop="handleDrop(event)" class="<?php if ($column->name == 'Completed') { echo 'completed'; } else if ($column->name == 'Lost') {  echo 'lost'; } else { echo 'normal'; } ?> pipeline-container bg-white d-block p-3 mt-1 mb-4 d-block">
                            <?php if ($cards) { ?>
                                <!-- Card -->
                                <?php foreach ($cards as $card) : ?>

<!--                                --><?php //print_r($card); ?>


                                    <div draggable="true" data-status="<?= $card->status ?>" data-percentage="<?= $card->percentage ?>" data-total-quote="<?= floatval($card->total_quote) ?>" ondragstart="handleDragStart(event)" id="card-<?= $card->card_id ?>" class="relative pipeline-block <?php if ($card->close_date) { echo_overdue($card->close_date); } ?> border-1 <?php if ($i === $count - 1) { echo 'p-3 pb-0'; } else { echo 'p-3'; } ?> mb-3">
                                        <strong><?php echo esc_html($card->name); ?></strong><br />
                                        <div class="pipeline-block-inner mt-2 mb-2">

                                            <?php
                                            global $accounts_team_single;
                                            accounts_team_single( $card->clientaccount, false);
                                            ?>
                                            <div style="align-items:center;display:flex;">
                                                <!-- User -->
                                                <div style="display:inline-block;width:fit-content;margin-right: 4px;" class="account_popup_container d-inline-block">
                                                    <?php if (!empty($card->assignee)) { ?>
                                                        <?php $online_date = online_status_true($card->assignee); ?>
                                                        <span class="table-image d-inline-block" data-bs-toggle="tooltip" style="top:3px !important;" data-bs-placement="top" title="<?= other_user_fullname($card->assignee); ?> (Currently: <?= $online_date[1] ?>)">
                                                        <span class="table-name d-inline-block"><?php
                                                            echo other_user_firstname($card->assignee)[0] . other_user_lastname($card->assignee)[0];
                                                            ?></span>
                                                        </span>
                                                    <?php } else { ?>
                                                        <?php $online_date = online_status_true($card->user_id); ?>
                                                        <span class="table-image d-inline-block" data-bs-toggle="tooltip" style="top:3px !important; background-color:#cacaca;" data-bs-placement="top" title="No User Currently Assigned">
                                                        </span>
                                                    <?php } ?>
                                                </div>
                                                <!-- Region -->
                                                <div style="display:inline-block;width:fit-content;margin-right: 4px;">
                                                    <?= get_region_flag($card->region); ?>
                                                </div>
                                                <!-- Account -->
                                                <div style="display:inline-block;width:fit-content;">
                                                    <?php if ($card->clientaccount) { ?>
                                                        <a class="account_icon_full badge-priority" style="background-color:rgba(<?= $accounts_team_single[0]->accountarray; ?>, 0.3)" href="page_accounts_view.php?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                                            <?= $accounts_team_single[0]->accountname; ?>
                                                        </a>
                                                    <?php } else { ?>
                                                        <span>-</span>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <!-- Close Date -->
                                            <div class="d-flex mb-1 mt-2" style="align-items: center; justify-content: space-between;">
                                                <p style="margin-bottom: 0 !important; line-height: 10px; font-size: 10px; color: #989898;">Close Date:</p>
                                                <?php if ($card->close_date) {
                                                    echo '<div class="badge-priority priority" style="background-color:#f5f5f5 !important;">' . formatted_date($card->close_date) . '</div>';
                                                } else {
                                                    echo '<div class="badge-priority priority" style="opacity: 0.3; background-color:#f5f5f5 !important;">Not Set</div>';
                                                } ?>
                                            </div>

                                            <!-- Total Quote -->
                                            <div class="d-flex mb-1 mt-1" style="align-items: center; justify-content: space-between;">
                                                <p style="margin-bottom: 0 !important; line-height: 10px; font-size: 10px; color: #989898;">Quote (Estimated):</p>
                                                <div class="badge-priority priority" style="background-color:#f5f5f5 !important;">
                                                    <?= form_currency($card->total_quote) ?>
                                                </div>
                                            </div>

                                            <!-- Category -->
                                            <!--<div class="d-flex mb-1 mt-1" style="align-items: center; justify-content: space-between;">-->
                                            <!--    <p style="margin-bottom: 0 !important; line-height: 10px; font-size: 10px; color: #989898;">Category:</p>-->
                                            <!--    <div class="badge-priority priority" style="background-color:#f5f5f5 !important;">-->
                                            <!--        --><?php //= $card->category ?>
                                            <!--    </div>-->
                                            <!--</div>-->

                                            <!-- Priority -->
                                            <div class="d-flex mb-2 mt-1" style="align-items: center; justify-content: space-between;">
                                                <p style="margin-bottom: 0 !important; line-height: 10px; font-size: 10px; color: #989898;">Priority:</p>
                                                <div class="badge-priority
                                                    <?php
                                                //Better Way of doing it, array lookup
//                                                    $priorities = [
//                                                        4 => 'priority-4',
//                                                        3 => 'priority-3',
//                                                        2 => 'priority-2',
//                                                        1 => 'priority-1',
//                                                    ];
//                                                    echo $priorities[$card->priority] ?? 'priority';

                                                if ($card->priority == 4) {
                                                        echo 'priority-4';
                                                    } elseif ($card->priority == 3) {
                                                        echo 'priority-3';
                                                    } elseif ($card->priority == 2) {
                                                        echo 'priority-2';
                                                    } elseif ($card->priority == 1) {
                                                        echo 'priority-1';
                                                    } else {
                                                        echo 'priority';
                                                    } ?>
                                                    ">
                                                    <i data-feather="flag" class="priority-flag"></i>
                                                    <?php
                                                        //Better Way of doing it, array lookup
//                                                    $priorities = [
//                                                        4 => 'Urgent',
//                                                        3 => 'High',
//                                                        2 => 'Medium',
//                                                        1 => 'Low',
//                                                    ];
//                                                    echo $priorities[$card->priority] ?? 'None';

                                                    if ($card->priority == 4) {
                                                        echo 'Urgent';
                                                    } elseif ($card->priority == 3) {
                                                        echo 'High';
                                                    } elseif ($card->priority == 2) {
                                                        echo 'Medium';
                                                    } elseif ($card->priority == 1) {
                                                        echo 'Low';
                                                    } else {
                                                        echo 'None';
                                                    } ?>
                                                </div>
                                            </div>

                                            <div class="overlay-buttons">
                                                <?php if ($card->status == 1) { ?>
                                                    <div class="deal-status-complete">
                                                        Completed (Closed: <?= formatted_date($card->completed_date) ?>)
                                                    </div>
                                                <?php } elseif ($card->status == 2) { ?>
                                                    <div class="deal-status-lost">
                                                        Lost (Closed: <?= formatted_date($card->completed_date) ?>)
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="deal-status-pending">
                                                        Open
                                                    </div>
                                                <?php } ?>
                                                <div class="overlay-buttons-inner">
                                                    <a class="btn btn-secondary btn-sm" href="/app/page_pipeline_view.php?displayid=<?= $card->displayid ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i data-feather="eye" style="height:11px;width:11px;"></i>
                                                    </a>
                                                    <a class="btn btn-secondary btn-sm" href="/app/page_pipeline_view.php?displayid=<?= $card->displayid ?>&tab=pipeline_settings" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <i data-feather="edit-2" style="height:11px;width:11px;"></i>
                                                    </a>
                                                    <button class="btn btn-success btn-sm btn-complete" data-bs-toggle="tooltip" data-bs-placement="top" title="Complete">
                                                        <i data-feather="check" style="pointer-events:none;height:11px;width:11px;"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm btn-lost" data-bs-toggle="tooltip" data-bs-placement="top" title="Lost">
                                                        <i data-feather="x" style="pointer-events:none;height:11px;width:11px;"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm btn-delete ms-2" data-card-id="<?= $card->card_id ?>">
                                                        <i data-feather="trash" style="pointer-events:none;height:11px;width:11px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex text-center">
                                                <div class="percentage-block">
                                                    <div class="percentage-block-inner" style="width:<?= $card->percentage ?>%;"></div>
                                                </div>
                                                <span class="ms-2" style="font-size: 10px;"><?= $card->percentage ?>%</span>
                                            </div>
                                        </div>
                                        <!-- Date -->
                                        <?php
                                        $creationDate = new DateTime($card->creation_date);
                                        $today = new DateTime();
                                        $diff = $today->diff($creationDate);
                                        $daysAgo = $diff->days === 0 ? 'Today' : $diff->days . ' days ago';
                                        ?>
                                        <small style="text-align: center;margin-bottom: 0 !important;line-height: 10px;font-size: 9px;color: #D0D0D1;width: 100%;display: block;margin-top: 6px;">
                                            Created By: <?= other_user_fullname($card->user_id); ?> on <?= formatted_date($card->creation_date) ?> (<?= $daysAgo ?>)
                                        </small>
                                    </div>

                                <?php endforeach; ?>
                            <?php } ?>
                        </div>
                        <!-- Add -->
<!--                        <button class="pipeline_add">-->
<!--                            <strong>Add +</strong>-->
<!--                        </button>-->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Delete Card -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.addEventListener("click", (event) => {
                if (event.target.classList.contains("btn-delete")) {
                    event.preventDefault();

                    const button = event.target;
                    const cardId = button.getAttribute("data-card-id");

                    if (!confirm("Are you sure you want to delete this deal?")) {
                        return;
                    }

                    fetch("/app/ajax/pipeline-delete.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: new URLSearchParams({
                            card_id: cardId,
                        }),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                const cardElement = document.getElementById("card-" + cardId);
                                if (cardElement) {
                                    const sourceColumn = cardElement.closest("[data-column-id]");
                                    const sourceColumnId = sourceColumn.getAttribute("data-column-id");

                                    cardElement.remove();

                                    updateColumnDisplay(sourceColumnId);

                                    updateOverallTotals();
                                }
                            } else {
                                alert("Error: " + data.message);
                            }
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            alert("An error occurred. Please try again.");
                        });
                }
            });
        });
    </script>

    <!-- Drag & Drop Functionality + Updating Cards -->
    <script>
        let ajaxurl = "/app/ajax/pipeline-move.php";

        function handleDragStart(event) {
            const cardElement = event.target;
            const cardId      = cardElement.id;
            const numericId   = cardId.split('-')[1];

            event.dataTransfer.setData("card_id", numericId);

            const parentColumn = cardElement.closest('[data-column-id]');
            if (parentColumn) {
                const sourceColumnId = parentColumn.getAttribute("data-column-id");
                event.dataTransfer.setData("source_column", sourceColumnId);
            }
        }

        function handleDrop(event) {
            event.preventDefault();

            const cardId = event.dataTransfer.getData("card_id");
            const sourceColumnId = event.dataTransfer.getData("source_column");
            const targetColumn = event.currentTarget;
            const targetColumnId = targetColumn.getAttribute("data-column-id");
            const targetColumnName = targetColumn.getAttribute("data-column-name");

            const cardElement = document.getElementById("card-" + cardId);
            targetColumn.appendChild(cardElement);

            if (targetColumnName) {
                updateCardStatusBasedOnColumn(cardElement, targetColumnName);
            }

            const formData = new FormData();
            formData.append("action", "move_card");
            formData.append("card_id", cardId);
            formData.append("target_column", targetColumnId);
            formData.append("target_column_name", targetColumnName);

            if (targetColumnName.toLowerCase().includes("completed") || targetColumnName.toLowerCase().includes("lost")) {
                formData.append("completed_date", new Date().toISOString().split('T')[0]);
            } else {
                formData.append("completed_date", "");
            }

            fetch(ajaxurl, {
                method: "POST",
                body: formData,
                credentials: "same-origin"
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Card moved successfully");

                    if (sourceColumnId && sourceColumnId !== targetColumnId) {
                        updateColumnDisplay(sourceColumnId);
                    }
                    if (targetColumnId) {
                        updateColumnDisplay(targetColumnId);
                    }

                    updateOverallTotals();
                } else {
                    console.error("Error moving card:", data);
                }
            })
            .catch(error => console.error("AJAX error:", error));
        }

        function updateColumnDisplay(columnId) {
            const columnElement = document.getElementById("column-" + columnId);
            if (!columnElement) return;

            const cardElements = columnElement.querySelectorAll(".pipeline-block");

            const count = cardElements.length;

            let sum = 0;
            cardElements.forEach(card => {
                let cardTotal = parseFloat(card.getAttribute("data-total-quote") || "0");
                sum += cardTotal;
            });

            const countSpan = document.getElementById("count-" + columnId);
            if (countSpan) {
                countSpan.textContent = count;
            }

            const totalSpan = document.getElementById("total-" + columnId);
            if (totalSpan) {
                totalSpan.textContent = formatAsCurrency(sum);
            }
        }

        function updateOverallTotals() {
            const allCards = document.querySelectorAll(".pipeline-block");

            let grandTotal = 0;
            let completedTotal = 0;
            let lostTotal = 0;
            let openTotal = 0;
            let openTotal90 = 0;

            allCards.forEach(card => {
                const cardTotal = parseFloat(card.getAttribute("data-total-quote") || "0");
                const cardPercentage = parseFloat(card.getAttribute("data-percentage") || "0");
                grandTotal += cardTotal;

                const parentColumn = card.closest("[data-column-id]");
                if (parentColumn) {
                    const columnName = parentColumn.getAttribute("data-column-name").toLowerCase();

                    if (columnName.includes("completed")) {
                        completedTotal += cardTotal;
                    } else if (columnName.includes("lost")) {
                        lostTotal += cardTotal;
                    } else {
                        openTotal += cardTotal;

                        if (cardPercentage >= 90) {
                            openTotal90 += cardTotal;
                        }
                    }
                }
            });

            const grandTotalElement = document.querySelector("#grand-total");
            if (grandTotalElement) {
                grandTotalElement.textContent = formatAsCurrency(grandTotal);
            }

            const completedTotalElement = document.querySelector("#completed-deals");
            if (completedTotalElement) {
                completedTotalElement.textContent = formatAsCurrency(completedTotal);
            }

            const lostTotalElement = document.querySelector("#lost-total");
            if (lostTotalElement) {
                lostTotalElement.textContent = formatAsCurrency(lostTotal);
            }

            const openTotalElement = document.querySelector("#open-total");
            if (openTotalElement) {
                openTotalElement.textContent = formatAsCurrency(openTotal);
            }

            const openTotal90Element = document.querySelector("#open-total-90");
            if (openTotal90Element) {
                openTotal90Element.textContent = formatAsCurrency(openTotal90);
            }
        }

        function formatAsCurrency(value) {
            return "£" + Number(value).toLocaleString("en-GB", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function updateCardStatusBasedOnColumn(cardElement, columnName) {
            const statusElement = cardElement.querySelector(".deal-status-complete, .deal-status-lost, .deal-status-pending");
            if (!statusElement) return;

            if (columnName.toLowerCase().includes("completed")) {
                statusElement.className = "deal-status-complete";
                statusElement.textContent = "Deal Completed";
            } else if (columnName.toLowerCase().includes("lost")) {
                statusElement.className = "deal-status-lost";
                statusElement.textContent = "Deal Lost";
            } else {
                statusElement.className = "deal-status-pending";
                statusElement.textContent = "Deal Open";
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateOverallTotals();
        });

        function moveToCompleteColumn(cardElement) {
            const completeColumn = document.querySelector('[data-column-name="Completed"]');
            if (completeColumn) {
                const columnId = completeColumn.getAttribute("data-column-id");
                const columnName = completeColumn.getAttribute("data-column-name");

                const originalColumn = cardElement.closest("[data-column-id]");
                const originalColumnId = originalColumn.getAttribute("data-column-id");

                completeColumn.appendChild(cardElement);

                updateCardStatusBasedOnColumn(cardElement, columnName);

                const cardId = cardElement.id.split('-')[1];
                const formData = new FormData();
                formData.append("action", "move_card");
                formData.append("card_id", cardId);
                formData.append("target_column", columnId);
                formData.append("target_column_name", columnName);
                formData.append("completed_date", new Date().toISOString().split('T')[0]);

                fetch(ajaxurl, {
                    method: "POST",
                    body: formData,
                    credentials: "same-origin"
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Card moved to Completed successfully");
                            updateColumnDisplay(columnId);
                            updateColumnDisplay(originalColumnId);
                            updateOverallTotals();
                        } else {
                            console.error("Error moving card to Completed:", data);
                        }
                    })
                    .catch(error => console.error("AJAX error:", error));
            } else {
                console.error("Completed column not found!");
            }
        }

        function moveToLostColumn(cardElement) {
            const lostColumn = document.querySelector('[data-column-name="Lost"]');
            if (lostColumn) {
                const columnId = lostColumn.getAttribute("data-column-id");
                const columnName = lostColumn.getAttribute("data-column-name");

                const originalColumn = cardElement.closest("[data-column-id]");
                const originalColumnId = originalColumn.getAttribute("data-column-id");

                lostColumn.appendChild(cardElement);

                updateCardStatusBasedOnColumn(cardElement, columnName);

                const cardId = cardElement.id.split('-')[1];
                const formData = new FormData();
                formData.append("action", "move_card");
                formData.append("card_id", cardId);
                formData.append("target_column", columnId);
                formData.append("target_column_name", columnName);
                formData.append("completed_date", new Date().toISOString().split('T')[0]);

                fetch(ajaxurl, {
                    method: "POST",
                    body: formData,
                    credentials: "same-origin"
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Card moved to Lost successfully");
                            updateColumnDisplay(columnId);
                            updateColumnDisplay(originalColumnId);
                            updateOverallTotals();
                        } else {
                            console.error("Error moving card to Lost:", data);
                        }
                    })
                    .catch(error => console.error("AJAX error:", error));
            } else {
                console.error("Lost column not found!");
            }
        }

        document.addEventListener("click", (event) => {
            if (event.target.matches(".btn-complete")) { // Complete action
                const cardElement = event.target.closest(".pipeline-block");
                if (cardElement) {
                    moveToCompleteColumn(cardElement);
                }
            } else if (event.target.matches(".btn-lost")) { // Lost action
                const cardElement = event.target.closest(".pipeline-block");
                if (cardElement) {
                    moveToLostColumn(cardElement);
                }
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const updateTotalCount = () => {
                let total = 0;

                document.querySelectorAll(".to-be-added").forEach(element => {
                    const value = parseInt(element.textContent.trim(), 10) || 0;
                    total += value;
                });

                const totalCountElement = document.getElementById("total-count");
                if (totalCountElement) {
                    totalCountElement.textContent = total;
                }
            };
            updateTotalCount();
        });
    </script>

    <!-- Filter System-->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const filterButton = document.getElementById("update-filter");
            if (filterButton) {

                filterButton.addEventListener("click", () => {
                    const creator = document.getElementById("creator").value;
                    const assignee = document.getElementById("assignee-filter").value;
                    const dealmake = document.getElementById("dealmake").value;
                    const createdFrom = document.getElementById("created_from").value;
                    const createdTo = document.getElementById("created_to").value;
                    const closeDateFilter = document.getElementById("close_date_filter").value;
                    const closedFrom = document.getElementById("closed_from").value;
                    const closedTo = document.getElementById("closed_to").value;
                    const closeDate = document.getElementById('close_date').value;
                    const priority = document.getElementById("priority").value;
                    const probability = document.getElementById("probability").value;
                    const region = document.getElementById("region").value;
                    const account = document.getElementById("account").value;

                    const urlParams = new URLSearchParams(window.location.search);

                    if (creator) {
                        urlParams.set("creator", creator);
                    } else {
                        urlParams.delete("creator");
                    }

                    if (assignee) {
                        urlParams.set("assignee", assignee);
                    } else {
                        urlParams.delete("assignee");
                    }

                    if (dealmake && dealmake !== "all") {
                        urlParams.set("make", dealmake);
                    } else {
                        urlParams.delete("make");
                    }

                    if (createdFrom) {
                        urlParams.set("created_from", createdFrom);
                    } else {
                        urlParams.delete("created_from");
                    }

                    if (createdTo) {
                        urlParams.set("created_to", createdTo);
                    } else {
                        urlParams.delete("created_to");
                    }

                    if (closeDateFilter && closeDateFilter !== "all") {
                        urlParams.set("close_date_filter", closeDateFilter);
                    } else {
                        urlParams.delete("close_date_filter");
                    }

                    if (closedFrom) {
                        urlParams.set('closed_from', closedFrom);
                    } else {
                        urlParams.delete("closed_from");
                    }

                    if (closedTo) {
                        urlParams.set('closed_to', closedTo);
                    } else {
                        urlParams.delete("closed_to");
                    }

                    if (closeDate) {
                        urlParams.set('close_date', closeDate);
                    } else {
                        urlParams.delete('close_date');
                    }

                    if (priority && priority !== "0") {
                        urlParams.set("priority", priority);
                    } else {
                        urlParams.delete("priority");
                    }

                    if (probability && probability !== "all") {
                        urlParams.set("probability", probability);
                    } else {
                        urlParams.delete("probability");
                    }

                    if (region && region !== "0") {
                        urlParams.set("region", region);
                    } else {
                        urlParams.delete("region");
                    }

                    if (account && account !== "") {
                        urlParams.set("account", account);
                    } else {
                        urlParams.delete("account");
                    }

                    // console.log(dealmake);

                    window.location.search = urlParams.toString();
                });
            }
        });
        document.addEventListener("DOMContentLoaded", () => {
            const resetButton = document.getElementById("reset-filter");

            if (resetButton) {
                resetButton.addEventListener("click", () => {
                    const urlParams = new URLSearchParams(window.location.search);

                    const pipelineId = urlParams.get("pipeline_id");

                    const newUrlParams = new URLSearchParams();
                    if (pipelineId) {
                        newUrlParams.set("pipeline_id", pipelineId);
                    }

                    window.location.search = newUrlParams.toString();
                });
            }
        });
    </script>
    <?php
}
?>
