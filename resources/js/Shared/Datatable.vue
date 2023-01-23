<template>
    <div>
        <table
            class="table table-hover table-bordered table-responsive"
            id="dt-tables"
        >
            <thead>
                <tr>
                    <th v-for="header in props.headers" :key="header.id">
                        <h6 v-html="header"></h6>
                    </th>
                </tr>
            </thead>
        </table>

        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog" style="width: 35%; text-align: center">
                <div class="modal-content" style="border-radius: 1rem">
                    <div class="modal-body">
                        <h3
                            v-if="state.button === 'trash'"
                            class="text-danger"
                            style="font-size: 1rem"
                        >
                            {{ __("Are you sure, you want to trash ?") }}
                        </h3>
                        <h3
                            v-if="state.button === 'delete'"
                            class="text-danger"
                            style="font-size: 1rem"
                        >
                            {{ __("Are you sure, you want to delete ?") }}
                        </h3>
                        <h3
                            v-if="state.button === 'restore'"
                            class="text-success"
                            style="font-size: 1rem"
                        >
                            {{ __("Are you sure, you want to restore ?") }}
                        </h3>
                    </div>
                    <div class="modal-footer flex-row justify-content-center">
                        <button
                            type="button"
                            class="btn btn-sm btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            {{ __("Cancel") }}
                        </button>
                        <button
                            type="button"
                            id="okButton"
                            v-if="state.button === 'trash'"
                            @click="trashRecord"
                            class="btn btn-sm btn-danger text-white"
                        >
                            {{ __("Confirm") }}
                        </button>
                        <button
                            type="button"
                            id="okButton"
                            v-if="state.button === 'delete'"
                            @click="deleteRecord"
                            class="btn btn-sm btn-danger text-white"
                        >
                            {{ __("Confirm") }}
                        </button>
                        <button
                            type="button"
                            id="okButton"
                            v-if="state.button === 'restore'"
                            @click="restoreRecord"
                            class="btn btn-sm btn-success text-white"
                        >
                            {{ __("Confirm") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "datatables.net-bs5/js/dataTables.bootstrap5";
import $ from "jquery";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, reactive, onMounted, watch } from "vue";
import { useToast } from "vue-toastification";
import { Inertia } from "@inertiajs/inertia";

const toast = useToast();
const props = defineProps({
    url: String,
    columns: Array,
    headers: Array,
    modelValue: Object,
});

const emit = defineEmits(["update:modelValue", "update:refreshDTble"]);
const query = usePage().props.value.ziggy.query;

const state = reactive({
    button: "",
    confirm_modal: null,
    actionUrl: null,
    itemArray: [],
});
const form = useForm();
const errorMessage = "Something went to wrong";
const trashedMessage = "Successfull trashed";
const restoreMessage = "Successfully restored";
const deleteMessage = "Successfully deleted";
const changeMessage = "Successfully changed";

let oTable = "";
onMounted(() => {
    state.confirm_modal = new bootstrap.Modal("#delete-modal", {
        keyboard: false,
    });
    oTable = $("#dt-tables")
        .on("processing.dt", function (e, settings, processing) {
            if (processing) {
                $("table").addClass("opacity-25");
            } else {
                $("table").removeClass("opacity-25");
            }
        })
        .DataTable({
            ajax: {
                url: props.url,
                data: function (q) {
                    q.datatable = 1;
                    q.status = query.status ?? "all";
                },
            },
            serverSide: true,
            processing: true,
            paging: true,
            columns: props.columns,
        });
    oTable.on("click", ".trash-record", function (e) {
        e.preventDefault();
        state.button = "trash";
        state.actionUrl = $(this).attr("href");
        state.confirm_modal.show();
    });
    oTable.on("click", ".edit-record", function (e) {
        e.preventDefault();
        Inertia.get($(this).attr("href"));
    });
    oTable.on("click", ".change-status-checkbox input", function (e) {
        e.preventDefault();
        form.get($(this).data("url"), {
            onSuccess: () => {
                toast.success(changeMessage);
                oTable.draw();
            },
            onError: () => {
                toast.error(errorMessage);
            },
        });
    });
    oTable.on("click", ".restore-record", function (e) {
        e.preventDefault();
        state.button = "restore";
        state.actionUrl = $(this).attr("href");
        state.confirm_modal.show();
    });
    oTable.on("click", ".delete-record", function (e) {
        e.preventDefault();
        state.button = "delete";
        state.actionUrl = $(this).attr("href");
        state.confirm_modal.show();
    });
    oTable.on("click", "#allCheckRow", function (e) {
        $("#dt-tables")
            .find("tbody input:checkbox")
            .prop("checked", $(this).prop("checked"));
        updateItemArray();
    });
    oTable.on("click", "tbody input:checkbox", function (e) {
        updateItemArray();
    });
    const updateItemArray = () => {
        state.itemArray = [];
        $("#dt-tables")
            .find("tbody input:checkbox")
            .each(function () {
                if (this.checked) {
                    state.itemArray.push($(this).val());
                }
            });
        emit("update:modelValue", state.itemArray);
    };
});
const trashRecord = () => {
    form.delete(state.actionUrl, {
        onSuccess: () => {
            toast.success(trashedMessage);
            oTable.draw();
        },
        onError: () => {
            toast.error(errorMessage);
        },
    });
    state.confirm_modal.hide();
};

const deleteRecord = () => {
    form.delete(state.actionUrl, {
        onSuccess: () => {
            toast.success(deleteMessage);
            oTable.draw();
        },
        onError: () => {
            toast.error(errorMessage);
        },
    });
    state.confirm_modal.hide();
};

const restoreRecord = () => {
    form.post(state.actionUrl, {
        onSuccess: () => {
            toast.success(restoreMessage);
            oTable.draw();
        },
        onError: () => {
            toast.error(errorMessage);
        },
    });
    state.confirm_modal.hide();
};

const refreshTbl = () => {
    oTable.draw();
};

defineExpose({
    refreshTbl,
});
</script>
