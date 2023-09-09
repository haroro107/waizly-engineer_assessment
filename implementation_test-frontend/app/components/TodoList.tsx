"use client";

import { ITask } from "@/types/tasks";
import React, { useState } from "react";
import Task from "./Task";

interface TodoListProps {
   tasks: ITask[];
}

const TodoList: React.FC<TodoListProps> = ({ tasks }) => {
   const [filterName, setFilterName] = useState<string>("");

   if (!tasks || tasks.length === 0) {
      return <div className="text-center">- Tidak ada data -</div>;
   }

   const filteredTasks = tasks.filter((task) => task.text.toLowerCase().includes(filterName.toLowerCase()));

   return (
      <div>
         <div className="mb-4">
            <input type="text" className="input input-bordered w-full" placeholder="Cari Task" value={filterName} onChange={(e) => setFilterName(e.target.value)} />
         </div>
         <div className="overflow-x-auto">
            <table className="table">
               <thead>
                  <tr>
                     <th>Task</th>
                     <th className="w-0">Action</th>
                  </tr>
               </thead>
               <tbody>
                  {filteredTasks.map((task) => (
                     <Task key={task.id} task={task} />
                  ))}
               </tbody>
            </table>
         </div>
      </div>
   );
};

export default TodoList;
