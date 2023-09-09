import { getPublicApi, listTodo } from "@/api";
import AddTask from "./components/AddTask";
import TodoList from "./components/TodoList";
import PublicApiList from "./components/PublicApiList";

export default async function Home() {
   const tasks = await listTodo("");
   const university = await getPublicApi();

   return (
      <main className="max-w-2xl mx-auto mt-4 p-2">
         <div className="card p-3 bg-base-100 shadow-xl">
            <div className="text-center my-5 flex flex-col gap-4">
               <h1 className="text-2xl font-bold">Aplikasi Todo List</h1>
               <AddTask />
            </div>
            <TodoList tasks={tasks} />
         </div>
         <div className="card p-3 bg-base-100 shadow-xl mt-3">
            <div className="text-center my-5 flex flex-col gap-4">
               <div>
                  <h1 className="text-2xl font-bold">Api Public List</h1>
                  <span>sumber public api : Hipo/university-domains-list</span>
               </div>
            </div>
            <PublicApiList university={university} />
         </div>
      </main>
   );
}
