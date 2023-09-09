"use client";

import { ITask } from "@/types/tasks";
import { FormEventHandler, useState } from "react";
import { FiBell, FiEdit, FiTrash } from "react-icons/fi";
import Modal from "./Modal";
import { useRouter } from "next/navigation";
import { deleteTodo, editTodo, statusTodo } from "@/api";

interface TaskProps {
   task: ITask;
}
const Task: React.FC<TaskProps> = ({ task }) => {
   const router = useRouter();
   const [openModalEdit, setOpenModalEdit] = useState<boolean>(false);
   const [openModalDelete, setOpenModalDelete] = useState<boolean>(false);

   const [taskToEdit, setTaskToEdit] = useState<string>(task.text);
   const [taskStatus, setTaskStatus] = useState<number>(task.status);

   const handleSubmitEditodo: FormEventHandler<HTMLFormElement> = async (e) => {
      e.preventDefault();
      await editTodo({
         id: task.id,
         text: taskToEdit,
         status: taskStatus,
      });
      setOpenModalEdit(false);
      router.refresh();
   };

   const handleDeleteTask = async (id: string) => {
      await deleteTodo(id);
      router.refresh();
   };

   const handleStatusTask = async (id: string) => {
      await statusTodo(id);
      router.refresh();
   };
   return (
      <tr key={task.id}>
         <td>
            <span onClick={() => handleStatusTask(task.id)} className={` ${task.status == 1 ? "" : "line-through text-red-500"}`}>
               {task.text}
            </span>
         </td>
         <td className="flex gap-5">
            <FiBell onClick={() => handleStatusTask(task.id)} className={`  ${task.status == 1 ? "text-blue-500" : " text-red-500"}`} cursor="pointer" size={18} />
            <FiEdit onClick={() => setOpenModalEdit(true)} cursor="pointer" className="text-yellow-500" size={18} />
            <Modal modalOpen={openModalEdit} setModalOpen={setOpenModalEdit}>
               <form onSubmit={handleSubmitEditodo}>
                  <h3 className="font-bold text-lg">Ubah task</h3>
                  <div className="modal-action">
                     <input value={taskToEdit} onChange={(e) => setTaskToEdit(e.target.value)} type="text" placeholder="Type here" className="input input-bordered w-full" />
                     <button type="submit" className="btn ">
                        Update
                     </button>
                  </div>
               </form>
            </Modal>
            <FiTrash onClick={() => setOpenModalDelete(true)} cursor="pointer" className="text-red-500" size={18} />
            <Modal modalOpen={openModalDelete} setModalOpen={setOpenModalDelete}>
               <h3 className="text-lg">Apakah task ini ingin anda hapus ?</h3>
               <div className="modal-action">
                  <button className="btn" onClick={() => handleDeleteTask(task.id)}>
                     Yes
                  </button>
               </div>
            </Modal>
         </td>
      </tr>
   );
};

export default Task;
