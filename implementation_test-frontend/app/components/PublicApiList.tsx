import { IUniversity } from "@/types/university";

interface UniversityListProps {
   university: IUniversity[];
}

const PublicApiList: React.FC<UniversityListProps> = ({ university }) => {
   return (
      <div className="overflow-x-auto">
         <table className="table">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Domain</th>
               </tr>
            </thead>
            <tbody>
               {university.map((item, index) => (
                  <tr key={index}>
                     <td>{item.name}</td>
                     <td>{item.domains[0]}</td>
                  </tr>
               ))}
            </tbody>
         </table>
      </div>
   );
};

export default PublicApiList;
